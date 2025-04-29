<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\Recipe;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        // Create ingredients
        $ingredients = [
            ['name' => 'Tomato', 'unit' => 'kg', 'cost_per_unit' => 2.50],
            ['name' => 'Onion', 'unit' => 'kg', 'cost_per_unit' => 1.75],
            ['name' => 'Chicken Breast', 'unit' => 'kg', 'cost_per_unit' => 8.99],
            ['name' => 'Rice', 'unit' => 'kg', 'cost_per_unit' => 3.25],
            ['name' => 'Olive Oil', 'unit' => 'liter', 'cost_per_unit' => 12.99],
            ['name' => 'Garlic', 'unit' => 'piece', 'cost_per_unit' => 0.25],
            ['name' => 'Bell Pepper', 'unit' => 'piece', 'cost_per_unit' => 1.50],
            ['name' => 'Salt', 'unit' => 'gram', 'cost_per_unit' => 0.001],
            ['name' => 'Black Pepper', 'unit' => 'gram', 'cost_per_unit' => 0.02],
            ['name' => 'Flour', 'unit' => 'kg', 'cost_per_unit' => 1.20],
            ['name' => 'Milk', 'unit' => 'liter', 'cost_per_unit' => 1.50],
            ['name' => 'Eggs', 'unit' => 'piece', 'cost_per_unit' => 0.35],
            ['name' => 'Butter', 'unit' => 'kg', 'cost_per_unit' => 9.99],
            ['name' => 'Cheese', 'unit' => 'kg', 'cost_per_unit' => 12.50],
            ['name' => 'Ground Beef', 'unit' => 'kg', 'cost_per_unit' => 10.75],
            ['name' => 'Lettuce', 'unit' => 'head', 'cost_per_unit' => 1.99],
            ['name' => 'Cucumber', 'unit' => 'piece', 'cost_per_unit' => 0.89],
            ['name' => 'Carrot', 'unit' => 'kg', 'cost_per_unit' => 1.50],
            ['name' => 'Sugar', 'unit' => 'kg', 'cost_per_unit' => 2.25],
            ['name' => 'Lemon', 'unit' => 'piece', 'cost_per_unit' => 0.75],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }

        // Assuming you have recipes with IDs 1, 2, and 3
        // Recipe 1: Spaghetti Bolognese
        $recipe1 = Recipe::find(1);
        if ($recipe1) {
            $recipe1->ingredients()->attach([
                1 => ['quantity' => 0.5],  // Tomato 500g
                2 => ['quantity' => 0.2],  // Onion 200g
                6 => ['quantity' => 3],    // Garlic 3 pieces
                15 => ['quantity' => 0.4], // Ground Beef 400g
                8 => ['quantity' => 5],    // Salt 5g
                9 => ['quantity' => 2],    // Black Pepper 2g
            ]);
        }

        // Recipe 2: Chicken Stir Fry
        $recipe2 = Recipe::find(2);
        if ($recipe2) {
            $recipe2->ingredients()->attach([
                3 => ['quantity' => 0.3],  // Chicken Breast 300g
                4 => ['quantity' => 0.25], // Rice 250g
                5 => ['quantity' => 0.03], // Olive Oil 30ml
                7 => ['quantity' => 2],    // Bell Pepper 2 pieces
                2 => ['quantity' => 0.15], // Onion 150g
                6 => ['quantity' => 2],    // Garlic 2 pieces
                8 => ['quantity' => 3],    // Salt 3g
                9 => ['quantity' => 1],    // Black Pepper 1g
            ]);
        }

        // Recipe 3: Omelette
        $recipe3 = Recipe::find(3);
        if ($recipe3) {
            $recipe3->ingredients()->attach([
                12 => ['quantity' => 3],    // Eggs 3 pieces
                13 => ['quantity' => 0.02], // Butter 20g
                14 => ['quantity' => 0.05], // Cheese 50g
                8 => ['quantity' => 2],     // Salt 2g
                9 => ['quantity' => 1],     // Black Pepper 1g
            ]);
        }
    }
}
