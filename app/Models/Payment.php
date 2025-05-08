<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'card_number',
        'expiry_date',
        'security_code',
        'phone_number',
        'address',
        'total_price',
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order that the payment is for.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Create a payment for an order using either the recipe's total price or ingredients cost
     * based on the is_ingredients_only flag
     * 
     * @param Order $order The order to create a payment for
     * @param array $paymentData Additional payment data
     * @return Payment The created payment
     */
    public static function createFromOrder(Order $order, array $paymentData)
    {
        // Determine which amount to use based on is_ingredients_only flag
        if ($order->is_ingredients_only) {
            $paymentData['total_price'] = $order->ingredients_cost;
        } else {
            // Get the recipe from the order and use its total price
            $recipe = $order->recipe;
            $paymentData['total_price'] = $recipe->total_price;
        }
        
        $paymentData['order_id'] = $order->id;
        
        // If user_id isn't provided but the order has one, use it
        if (!isset($paymentData['user_id']) && $order->user_id) {
            $paymentData['user_id'] = $order->user_id;
        }
        
        // Create and return the payment
        return self::create($paymentData);
    }
    
    /**
     * Calculate the total price for an order based on is_ingredients_only flag
     * This can be used before creating a payment to show the user the total
     * 
     * @param Order $order
     * @return float
     */
    public static function calculateTotalPriceForOrder(Order $order)
    {
        return $order->is_ingredients_only ? $order->ingredients_cost : $order->recipe->total_price;
    }
    
    /**
     * Calculate the total price for a recipe
     * This can be used before creating a payment to show the user the total
     * 
     * @param Recipe $recipe
     * @return float
     * @deprecated Use calculateTotalPriceForOrder instead
     */
    public static function calculateTotalPriceForRecipe(Recipe $recipe)
    {
        return $recipe->total_price;
    }
}