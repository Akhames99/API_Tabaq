<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            ['user_id' => 1, 'recipe_id' => 1, 'rating' => 4],
            ['user_id' => 2, 'recipe_id' => 2, 'rating' => 5],
            ['user_id' => 3, 'recipe_id' => 3, 'rating' => 3],
            ['user_id' => 4, 'recipe_id' => 4, 'rating' => 4]
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}