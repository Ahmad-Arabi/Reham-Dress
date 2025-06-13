<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::first();
        $product = Product::first();
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'color' => 'Red',
            'age' => '5 years',
            'quantity' => 2,
            'price' => 50.00,
        ]);
    }
}
