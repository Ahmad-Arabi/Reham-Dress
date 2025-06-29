<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\OrderItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@info.com',
            'password' => Hash::make('adminuser444'),
            'phone' =>  '0772479467',
            'role' => 'admin'
        ]);
    }
}
