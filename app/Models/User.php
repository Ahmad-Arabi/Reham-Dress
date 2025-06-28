<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
         return $this->hasMany(Order::class);
    }
// public function isAdmin(): bool
// {
//     return $this->role === 'admin';
// }



    /**
     * Get user's total orders count.
     */
    public function getTotalOrdersAttribute()
    {
        return $this->orders()->count();
    }

    /**
     * Get user's total spent amount.
     */
    public function getTotalSpentAttribute()
    {
        return $this->orders()->sum('total_amount');
    }

    /**
     * Get user's completed orders count.
     */
    public function getCompletedOrdersAttribute()
    {
        return $this->orders()->where('status', 'delivered')->count();
    }

    /**
     * Get user's pending orders count.
     */
    public function getPendingOrdersAttribute()
    {
        return $this->orders()->whereIn('status', ['pending', 'processing', 'shipped'])->count();
    }
}
