<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'افطار', 'description' => 'ابدأ يومك بأكله جميلة'],
            ['name' => 'غداء', 'description' => 'جدد طاقتك بأكله حلوة'],
            ['name' => 'عشاء', 'description' => 'جمع عيلتك علي أكله لطيفة'],
            ['name' => 'تحليه', 'description' => 'حلي وادعيلي مع أكله ميري']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}