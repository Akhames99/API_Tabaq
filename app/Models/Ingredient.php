<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $fillable = ['name', 'unit', 'cost_per_unit' ,'image_url'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredient','ingredient_id','recipe_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
