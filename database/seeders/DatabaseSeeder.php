<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Call other seeders
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            CuisineTypeSeeder::class,
            RecipeSeeder::class,
            IngredientSeeder::class,
            ReviewSeeder::class
            // Add RecipeSeeder later if needed
        ]);
    }
}