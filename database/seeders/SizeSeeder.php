<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
use App\Models\Product;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            Size::create([
                'product_id' => $product->id,
                'age' => fake()->numberBetween(1, 12) . ' years',
            ]);
        }
    }
}
