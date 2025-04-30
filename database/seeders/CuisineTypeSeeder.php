<?php

namespace Database\Seeders;

use App\Models\Cuisine_Type;
use Illuminate\Database\Seeder;

class CuisineTypeSeeder extends Seeder
{
    public function run(): void
    {
        $cuisineTypes = [
            ['name' => 'شرقي', 'description' => 'أكلات من المطبخ الشرقية'],
            ['name' => 'غربي', 'description' => 'أكلات من المطبخ الغربية']
        ];

        foreach ($cuisineTypes as $cuisineType) {
            Cuisine_Type::create($cuisineType);
        }
    }
}