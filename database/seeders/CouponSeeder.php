<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'WELCOME10',
            'discount' => 10.00,
            'start_date' => now()->subDays(10),
            'expiry_date' => now()->addDays(20),
            'isFeatured' => true,
        ]);
        Coupon::create([
            'code' => 'SUMMER20',
            'discount' => 20.00,
            'start_date' => now()->subDays(5),
            'expiry_date' => now()->addDays(10),
            'isFeatured' => false,
        ]);
    }
}
