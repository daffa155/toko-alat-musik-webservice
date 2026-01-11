<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'name' => 'Gitar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Drum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
