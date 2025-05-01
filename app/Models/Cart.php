<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipe_id',
        'is_ingredients_only',
        'recipe_price',
        'ingredients_cost',
        'quantity'
    ];

    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the recipe associated with the cart item.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}