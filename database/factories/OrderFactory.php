<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'total_amount' => $this->faker->randomFloat(2, 50, 1000),
            'discount_amount' => $this->faker->randomFloat(2, 0, 100),
            'coupon_id' => Coupon::factory(),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
        ];
    }
}
