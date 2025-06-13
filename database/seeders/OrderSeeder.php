<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $coupon = Coupon::first();
        Order::create([
            'user_id' => $user->id,
            'address' => '123 Test St',
            'phone' => '1234567890',
            'total_amount' => 100.00,
            'discount_amount' => 10.00,
            'coupon_id' => $coupon->id,
            'status' => 'pending',
        ]);
    }
}
