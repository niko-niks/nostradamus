<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::getCarCategories();

        foreach ($categories as $slug => $categoryData) {
            Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'icon' => $categoryData['icon'],
                ]
            );
        }

        $this->command->info('Car categories created successfully!');
    }
}
