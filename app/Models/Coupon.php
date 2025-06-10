<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'start_date',
        'expiry_date',
        'isFeatured',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
