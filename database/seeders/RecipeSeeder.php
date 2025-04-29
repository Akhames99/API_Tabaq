<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        $recipes = [
            [
                'name' => 'Spaghetti Bolognese',
                'description' => 'Classic Italian pasta dish with rich meat sauce',
                'price' => 20.23,
                'image_url' => 'https://example.com/images/spaghetti_bolognese.jpg',
                'cuisine_type_id' => 2, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'Chicken Stir Fry',
                'description' => 'Quick and healthy Asian-inspired stir fry with vegetables',
                'price' => 29.02,
                'image_url' => 'https://example.com/images/chicken_stir_fry.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'Cheese Omelette',
                'description' => 'Simple and delicious breakfast omelette with cheese',
                'price' => 9.66,
                'image_url' => 'https://example.com/images/cheese_omelette.jpg',
                'cuisine_type_id' => 2, // Western
                'categories'=>[1,3]
            ],
            [
                'name' => 'Beef Shawarma',
                'description' => 'Middle Eastern wrap with marinated beef and tahini sauce',
                'price' => 30.23,
                'image_url' => 'https://example.com/images/beef_shawarma.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Classic salad with romaine lettuce, croutons, and Caesar dressing',
                'price' => 8.44,
                'image_url' => 'https://example.com/images/caesar_salad.jpg',
                'cuisine_type_id' => 2, // Western
                'categories'=>[1,3]
            ],
            [
                'name' => 'Vegetable Biryani',
                'description' => 'Fragrant rice dish with mixed vegetables and aromatic spices',
                'price' => 6.21,
                'image_url' => 'https://example.com/images/vegetable_biryani.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[3]
            ],
            [
                'name' => 'Mushroom Risotto',
                'description' => 'Creamy Italian rice dish with mushrooms and Parmesan',
                'price' => 11.88,
                'image_url' => 'https://example.com/images/mushroom_risotto.jpg',
                'cuisine_type_id' => 2, // Western
                'categories'=>[1,3]
            ],
            [
                'name' => 'Pad Thai',
                'description' => 'Thai stir-fried noodles with egg, tofu, and peanuts',
                'price' => 33,
                'image_url' => 'https://example.com/images/pad_thai.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'Beef Burger',
                'description' => 'Juicy beef patty with cheese and fresh vegetables',
                'price' => 26.23,
                'image_url' => 'https://example.com/images/beef_burger.jpg',
                'cuisine_type_id' => 2, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'Chicken Curry',
                'description' => 'Aromatic curry with tender chicken pieces',
                'price' => 27.63,
                'image_url' => 'https://example.com/images/chicken_curry.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
        ];

        foreach ($recipes as $recipeData) {
            $categories = $recipeData['categories'] ?? [];
        
            // 🚀 IMPORTANT: remove 'categories' before calling create()
            unset($recipeData['categories']);
        
            $recipe = Recipe::create($recipeData);
        
            if (!empty($categories)) {
                $recipe->categories()->attach($categories);
            }
        }                
    }
}