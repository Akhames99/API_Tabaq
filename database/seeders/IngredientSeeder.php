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
            ['name' => 'طماطم', 'unit' => 'كيلو', 'cost_per_unit' => 10],
            ['name' => 'بصل', 'unit' => 'كيلو', 'cost_per_unit' => 8],
            ['name' => 'صدور فراخ', 'unit' => 'كيلو', 'cost_per_unit' => 185],
            ['name' => 'أرز', 'unit' => 'كيلو', 'cost_per_unit' => 45],
            ['name' => 'زيت', 'unit' => 'لتر', 'cost_per_unit' => 40],
            ['name' => 'ثوم', 'unit' => 'قطعة', 'cost_per_unit' => 3],
            ['name' => 'فلفل أسود', 'unit' => 'جرام', 'cost_per_unit' => 4],
            ['name' => 'ملح', 'unit' => 'جرام', 'cost_per_unit' => 2],
            ['name' => 'دقيق', 'unit' => 'كيلو', 'cost_per_unit' => 20],
            ['name' => 'لبن', 'unit' => 'لتر', 'cost_per_unit' => 48],
            ['name' => 'بيض', 'unit' => 'قطعة', 'cost_per_unit' => 6],
            ['name' => 'زبدة', 'unit' => 'كيلو', 'cost_per_unit' => 60],
            ['name' => 'جبنة', 'unit' => 'كيلو', 'cost_per_unit' => 70],
            ['name' => 'لحم مفروم', 'unit' => 'كيلو', 'cost_per_unit' => 140],
            ['name' => 'خَسّ', 'unit' => 'قطعة', 'cost_per_unit' => 7],
            ['name' => 'خيار', 'unit' => 'كيلو', 'cost_per_unit' => 15],
            ['name' => 'جزر', 'unit' => 'كيلو', 'cost_per_unit' => 12],
            ['name' => 'سكر', 'unit' => 'جرام', 'cost_per_unit' => 0.03],
            ['name' => 'ليمون', 'unit' => 'قطعة', 'cost_per_unit' => 0.5],
            ['name' => 'كنافة', 'unit' => 'كيلو', 'cost_per_unit' => 35],
            ['name' => 'كريمة', 'unit' => 'كيلو', 'cost_per_unit' => 30],
            ['name' => 'ماء الورد', 'unit' => 'لتر', 'cost_per_unit' => 10],
            ['name' => 'فستق', 'unit' => 'كيلو', 'cost_per_unit' => 450],
            ['name' => 'عسل', 'unit' => 'جرام', 'cost_per_unit' => 2],
            ['name' => 'جوز الهند', 'unit' => 'الكيلو', 'cost_per_unit' => 260],
            ['name' => 'البيكنج باودر', 'unit' => 'جرام', 'cost_per_unit' => 0.1],
            ['name' => 'زبادي', 'unit' => 'علبة', 'cost_per_unit' => 4],
            ['name' => 'فانيليا', 'unit' => 'جرام', 'cost_per_unit' => 0.5],
            ['name' => 'مكسرات', 'unit' => 'كيلو', 'cost_per_unit' => 200],
            ['name' => 'زبيب', 'unit' => 'كيلو', 'cost_per_unit' => 20],
            ['name' => 'ورق الجلاتين', 'unit' => 'قطعة', 'cost_per_unit' => 15],
            ['name' => 'برتقال', 'unit' => 'كيلو', 'cost_per_unit' => 15],
            ['name' => 'السميد', 'unit' => 'كيلو', 'cost_per_unit' => 40],
            ['name' => 'قرفة', 'unit' => 'جرام', 'cost_per_unit' => 0.3],
            ['name' => 'تمر', 'unit' => 'كيلو', 'cost_per_unit' => 30],
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
