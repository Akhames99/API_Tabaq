<?php

namespace Database\Seeders;

use App\Models\Cuisine_Type;
use Illuminate\Database\Seeder;

class CuisineTypeSeeder extends Seeder
{
    public function run(): void
    {
        $cuisineTypes = [
            ['name' => 'Eastern', 'description' => 'Cuisine from Eastern cultures'],
            ['name' => 'Western', 'description' => 'Cuisine from Western cultures']
        ];

        foreach ($cuisineTypes as $cuisineType) {
            Cuisine_Type::create($cuisineType);
        }
    }
}