<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
use App\Models\Product;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            Color::create([
                'product_id' => $product->id,
                'color' => fake()->safeColorName(),
            ]);
        }
    }
}
