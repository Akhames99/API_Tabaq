<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Breakfast', 'description' => 'Morning meals to start your day'],
            ['name' => 'Lunch', 'description' => 'Midday meals for energy'],
            ['name' => 'Dinner', 'description' => 'Evening meals for family gatherings'],
            ['name' => 'Dessert', 'description' => 'Sweet treats to end your meal']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}