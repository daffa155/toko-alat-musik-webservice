<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Gitar Akustik Yamaha',
                'description' => 'Gitar akustik berkualitas untuk pemula dan profesional',
                'price' => 1500000,
                'stock' => 10,
                'category_id' => 1
            ],
            [
                'name' => 'Drum Pearl',
                'description' => 'Drum set profesional untuk studio dan panggung',
                'price' => 7000000,
                'stock' => 5,
                'category_id' => 2
            ],
        ]);
    }
}
