<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    protected $table = 'recipes';

    protected $fillable = ['name', 'description', 'price', 'image_url', 'cuisine_type_id'];

    // Many-to-many relationship with categories
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'recipe_category' , 'recipe_id', 'category_id');
    }

    // Belongs-to relationship with cuisine type
    public function cuisineType(): BelongsTo
    {
        return $this->belongsTo(Cuisine_Type::class, 'cuisine_type_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class , 'recipe_ingredient','recipe_id','ingredient_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
