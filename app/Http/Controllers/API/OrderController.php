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
            'quantity' => 'required|integer|min:1',
        ]);

        // Get recipe with its ingredients
        $recipe = Recipe::with('ingredients.recipes')->findOrFail($validatedData['recipe_id']);
        
        // Calculate ingredients cost
        $ingredientsCost = 0;
        foreach ($recipe->ingredients as $ingredient) {
            $ingredientsCost += $ingredient->cost_per_unit * $ingredient->pivot->quantity;
        }
        
        // Multiply ingredients cost by quantity
        $ingredientsCost = $ingredientsCost * $validatedData['quantity'];
        
        // Add delivery fee to ingredients cost
        $ingredientsCostWithFee = $ingredientsCost + self::DELIVERY_FEE;

        // Calculate total price (recipe price * quantity + delivery fee)
        $totalPrice = ($recipe->price * $validatedData['quantity']) + self::DELIVERY_FEE;

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'recipe_id' => $validatedData['recipe_id'],
            'ingredients_cost' => $ingredientsCostWithFee,
            'quantity' => $validatedData['quantity'],
            'total_price' => $totalPrice,
        ]);

        // Load recipe relationship
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

        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'recipe_id' => 'sometimes|required|exists:recipes,id',
            'quantity' => 'sometimes|required|integer|min:1',
        ]);

        // If recipe or quantity changed, we need to recalculate costs
        if (isset($validatedData['recipe_id']) || isset($validatedData['quantity'])) {
            $recipe = Recipe::with('ingredients.recipes')
                ->findOrFail($validatedData['recipe_id'] ?? $order->recipe_id);
            
            // Calculate ingredients cost
            $ingredientsCost = 0;
            foreach ($recipe->ingredients as $ingredient) {
                $ingredientsCost += $ingredient->cost_per_unit * $ingredient->pivot->quantity;
            }
            
            $quantity = $validatedData['quantity'] ?? $order->quantity;
            
            // Multiply ingredients cost by quantity
            $ingredientsCost = $ingredientsCost * $quantity;
            
            // Add delivery fee to ingredients cost
            $ingredientsCostWithFee = $ingredientsCost + self::DELIVERY_FEE;
            
            // Calculate total price (recipe price * quantity + delivery fee)
            $totalPrice = ($recipe->price * $quantity) + self::DELIVERY_FEE;
            
            $validatedData['ingredients_cost'] = $ingredientsCostWithFee;
            $validatedData['total_price'] = $totalPrice;
        }

        $order->update($validatedData);
        
        // Reload the order with recipe
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