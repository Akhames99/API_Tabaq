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
                'name' => 'سباغيتي مع قطع اللحم المفروم',
                'description' => '',
                'price' => 90,
                'image_url' => 'https://drive.google.com/file/d/1BoWCSq8fvJosfY3MWNHICE_cfIGzmVae/view?usp=sharing',
                'cuisine_type_id' => 2, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'لحم بقري مشوي مع البطاطس والفلفل',
                'description' => '',
                'price' => 170,
                'image_url' => 'https://drive.google.com/file/d/1wB-5H0dCWUVUdJW4GzCvSsEmVuXHyg-J/view?usp=sharing',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'لحم بقري مع فلفل رومي ملون',
                'description' => '',
                'price' => 190,
                'image_url' => 'https://drive.google.com/file/d/1qNk63nA0kra_ygnPe8yrQ6ONBI9cDZYC/view?usp=sharing',
                'cuisine_type_id' => 1, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'لحم مشوي مع الفلفل (مطبخ آسيوي)',
                'description' => '',
                'price' => 120,
                'image_url' => 'https://drive.google.com/file/d/1E9clqy73bc0ajvvT9P9s4cuaDqR7fr7X/view?usp=sharing',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'مكرونة بيني مع الدجاج وصلصة الطماطم',
                'description' => '',
                'price' => 65,
                'image_url' => 'https://drive.google.com/file/d/1y_j0K_1tfmNs7UcHmgngLiBmspeTg-yr/view?usp=sharing',
                'cuisine_type_id' => 2, // Western
                'categories'=>[2,3]
            ],
            [
                'name' => 'سمك دورادو مخبوز مع الليمون وسلطة جاهزة',
                'description' => '',
                'price' => 95,
                'image_url' => 'https://drive.google.com/file/d/1DnkabobbBD3l9stPjMGb1I_V6Pn310R0/view?usp=sharing',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2,3]
            ],
            [
                'name' => 'بطاطس مخبوزة مع البصل والثوم والأعشاب',
                'description' => '',
                'price' => 50,
                'image_url' => 'https://drive.google.com/file/d/1_OgiIY2IkRtLwW8p7m71MJIs8o58PktL/view?usp=sharing',
                'cuisine_type_id' => 1, // Western
                'categories'=>[1,2,3]
            ],
            [
                'name' => 'كبد دجاج مقلي مع صلصة التوت البري',
                'description' => '',
                'price' => 70,
                'image_url' => 'https://drive.google.com/file/d/1qlESWwlx7wYnNEwkxv-J4SA_SkH9SFhv/view?usp=sharing',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'أسياخ دجاج مع الفلفل الحلو والشبت',
                'description' => '',
                'price' => 105,
                'image_url' => 'https://drive.google.com/file/d/1cfEL57dAJvzln94LKeszLDufMVpz-3J7/view?usp=sharing',
                'cuisine_type_id' => 1, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'مكرونة بيني مع الدجاج وصلصة الطماطم',
                'description' => '',
                'price' => 60,
                'image_url' => 'https://drive.google.com/file/d/1muEnIa8y-JEmuo7Pl29WqXUEPLNyROlK/view?usp=sharing',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'كباب نباتي بالخضروات مع صلصة الكاجو والبابريكا',
                'description' => '',
                'price' => 120,
                'image_url' => 'https://drive.google.com/file/d/1o6XigRwSENN01_mleeLD2atphmMb_pZA/view?usp=sharing',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'تورتيلا ملفوفة بالفلافل والسلطة',
                'description' => '',
                'price' => 80,
                'image_url' => 'https://drive.google.com/file/d/1PPIVUKgyDvB9rxqg2lIR18Fy3hVnerYi/view?usp=sharing',
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