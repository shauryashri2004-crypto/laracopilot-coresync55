<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Breakfast', 'description' => 'Fresh morning meals to start your day', 'icon' => '🌅', 'active' => true],
            ['name' => 'Meals', 'description' => 'Full thali meals and rice combos', 'icon' => '🍱', 'active' => true],
            ['name' => 'Snacks', 'description' => 'Quick bites and evening snacks', 'icon' => '🥪', 'active' => true],
            ['name' => 'Beverages', 'description' => 'Hot and cold drinks', 'icon' => '☕', 'active' => true],
            ['name' => 'Desserts', 'description' => 'Sweet treats and desserts', 'icon' => '🍮', 'active' => true],
            ['name' => 'Fast Food', 'description' => 'Burgers, sandwiches and more', 'icon' => '🍔', 'active' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}