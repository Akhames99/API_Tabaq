<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as RoutingController;

class OrderController extends RoutingController
{
    // Delivery fee constant
    const DELIVERY_FEE = 30.00;

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('recipe')
            ->get();

        return response()->json($orders);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'recipe_quantity' => 'sometimes|integer|min:0',
            'ingredients_quantity' => 'sometimes|integer|min:0',
        ]);

        $recipe = Recipe::with('ingredients.recipes')->findOrFail($validatedData['recipe_id']);

        $recipeQty = $validatedData['recipe_quantity'] ?? 0;
        $ingredientsQty = $validatedData['ingredients_quantity'] ?? 0;

        if ($recipeQty === 0 && $ingredientsQty === 0) {
            return response()->json(['message' => 'At least one of recipe_quantity or ingredients_quantity must be greater than 0.'], 422);
        }

        // Calculate ingredients cost
        $ingredientsCost = 0;
        foreach ($recipe->ingredients as $ingredient) {
            $ingredientsCost += $ingredient->cost_per_unit * $ingredient->pivot->quantity;
        }
        $ingredientsCostTotal = $ingredientsCost * $ingredientsQty;

        // Calculate recipe price
        $recipeTotal = $recipe->price * $recipeQty;

        // Sum ingredients cost and recipe price
        $totalBeforeFee = $recipeTotal + $ingredientsCostTotal;

        // Add delivery fee
        $totalPrice = $totalBeforeFee + self::DELIVERY_FEE;

        $order = Order::create([
            'user_id' => Auth::id(),
            'recipe_id' => $validatedData['recipe_id'],
            'recipe_quantity' => $recipeQty,
            'ingredients_quantity' => $ingredientsQty,
            'ingredients_cost' => $ingredientsCostTotal + self::DELIVERY_FEE,
            'total_price' => $totalPrice,  // Sum of ingredients cost and recipe price + delivery fee
            'is_ingredients_only' => $recipeQty === 0,
        ]);

        $order->load('recipe');

        return response()->json($order, 201);
    }




    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('recipe.ingredients.recipes')
            ->findOrFail($id);

        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->recipe_price = $order->recipe->price;

        return response()->json($order);
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'recipe_id' => 'sometimes|required|exists:recipes,id',
            'recipe_quantity' => 'sometimes|integer|min:0',
            'ingredients_quantity' => 'sometimes|integer|min:0',
        ]);

        $recipe = Recipe::with('ingredients.recipes')
            ->findOrFail($validatedData['recipe_id'] ?? $order->recipe_id);

        $recipeQty = $validatedData['recipe_quantity'] ?? $order->recipe_quantity;
        $ingredientsQty = $validatedData['ingredients_quantity'] ?? $order->ingredients_quantity;

        if ($recipeQty === 0 && $ingredientsQty === 0) {
            return response()->json(['message' => 'At least one of recipe_quantity or ingredients_quantity must be greater than 0.'], 422);
        }

        // Recalculate ingredients cost
        $ingredientsCost = 0;
        foreach ($recipe->ingredients as $ingredient) {
            $ingredientsCost += $ingredient->cost_per_unit * $ingredient->pivot->quantity;
        }
        $ingredientsCostTotal = $ingredientsCost * $ingredientsQty;

        // Calculate recipe price
        $recipeTotal = $recipe->price * $recipeQty;

        // Sum ingredients cost and recipe price
        $totalBeforeFee = $recipeTotal + $ingredientsCostTotal;

        // Add delivery fee
        $totalPrice = $totalBeforeFee + self::DELIVERY_FEE;

        $order->update([
            'recipe_id' => $recipe->id,
            'quantity' => $recipeQty,
            'recipe_quantity' => $recipeQty,
            'ingredients_quantity' => $ingredientsQty,
            'ingredients_cost' => $ingredientsCostTotal + self::DELIVERY_FEE,
            'total_price' => $totalPrice,  // Sum of ingredients cost and recipe price + delivery fee
            'is_ingredients_only' => $recipeQty === 0,
        ]);

        $order->load('recipe');

        return response()->json($order);
    }



    /**
     * Remove the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->delete();
        return response()->json(['message' => 'Your order is cancelled.']);
    }
}
