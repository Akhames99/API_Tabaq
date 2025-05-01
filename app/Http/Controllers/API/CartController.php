<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as RoutingController;

class CartController extends RoutingController
{
    /**
     * Get the cart items for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = Auth::id();
        
        $cartItems = Cart::where('user_id', $userId)
            ->with('recipe:id,name,description,image_url')
            ->get();
        
        // Calculate totals
        $totalRecipePrice = 0;
        $totalIngredientsPrice = 0;
        
        foreach ($cartItems as $item) {
            if (!$item->is_ingredients_only) {
                $totalRecipePrice += $item->recipe_price * $item->quantity;
            }
            $totalIngredientsPrice += $item->ingredients_cost * $item->quantity;
        }
        
        $grandTotal = $totalRecipePrice + $totalIngredientsPrice;
        
        return response()->json([
            'status' => 'success',
            'cart_items' => $cartItems,
            'summary' => [
                'total_recipe_price' => $totalRecipePrice,
                'total_ingredients_price' => $totalIngredientsPrice,
                'grand_total' => $grandTotal
            ]
        ]);
    }

    /**
     * Add an item to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipe_id' => 'required|exists:recipes,id',
            'is_ingredients_only' => 'required|boolean',
            'quantity' => 'required|integer|min:1'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $userId = Auth::id();
        $recipeId = $request->recipe_id;
        $isIngredientsOnly = $request->is_ingredients_only;
        
        // Get recipe details
        $recipe = Recipe::findOrFail($recipeId);
        
        // Check if this item already exists in the cart
        $existingCartItem = Cart::where('user_id', $userId)
            ->where('recipe_id', $recipeId)
            ->where('is_ingredients_only', $isIngredientsOnly)
            ->first();
        
        if ($existingCartItem) {
            // Update quantity
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
            
            $cartItem = $existingCartItem;
            $message = 'Cart item quantity updated';
        } else {
            // Create new cart item
            $cartItem = Cart::create([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
                'is_ingredients_only' => $isIngredientsOnly,
                'recipe_price' => $isIngredientsOnly ? null : $recipe->price,
                'ingredients_cost' => $recipe->ingredients_cost,
                'quantity' => $request->quantity
            ]);
            
            $message = 'Item added to cart';
        }
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'cart_item' => $cartItem->load('recipe:id,name,description,image_url')
        ], 201);
    }

    /**
     * Update the quantity of a cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $userId = Auth::id();
        
        $cartItem = Cart::where('id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$cartItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ], 404);
        }
        
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cart item updated',
            'cart_item' => $cartItem->load('recipe:id,name,description,image_url')
        ]);
    }

    /**
     * Remove an item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $userId = Auth::id();
        
        $cartItem = Cart::where('id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$cartItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ], 404);
        }
        
        $cartItem->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart'
        ]);
    }

    /**
     * Clear all items from the cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        $userId = Auth::id();
        
        Cart::where('user_id', $userId)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared'
        ]);
    }
}