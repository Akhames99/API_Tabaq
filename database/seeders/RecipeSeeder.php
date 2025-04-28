<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Create some test recipes
        $recipes = [
            [
                'name' => 'Pancakes',
                'description' => 'Fluffy breakfast pancakes',
                'price' => 9.99,
                'image_url' => 'https://example.com/images/pancakes.jpg',
                'cuisine_type_id' => 2, // Western
                'categories' => [1] // Breakfast
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Classic Caesar salad with croutons',
                'price' => 12.99,
                'image_url' => 'https://example.com/images/caesar-salad.jpg',
                'cuisine_type_id' => 2, // Western
                'categories' => [2] // Lunch
            ],
            [
                'name' => 'Sushi Platter',
                'description' => 'Assorted fresh sushi',
                'price' => 24.99,
                'image_url' => 'https://example.com/images/sushi.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories' => [2, 3] // Lunch and Dinner
            ]
        ];

        foreach ($recipes as $recipeData) {
            $categories = $recipeData['categories'];
            unset($recipeData['categories']);
            
            $recipe = Recipe::create($recipeData);
            $recipe->categories()->attach($categories);
        }
    }
}