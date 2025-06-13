<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('COUPON-####'),
            'discount' => $this->faker->randomFloat(2, 5, 50),
            'start_date' => now()->subDays(rand(1, 30)),
            'expiry_date' => now()->addDays(rand(1, 30)),
            'isFeatured' => $this->faker->boolean(),
        ];
    }
}
