<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'total_amount',
        'discount_amount',
        'coupon_id',
        'status',
        'payment_method',
        'shipping_fee',
        'tracking',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the coupon associated with the order.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the status in Arabic.
     */
    public function getStatusArabicAttribute()
    {
        $statusMap = [
            'pending' => 'قيد الانتظار',
            'processing' => 'قيد التنفيذ',
            'shipped' => 'تم الشحن',
            'delivered' => 'تم التسليم',
            'cancelled' => 'ملغي',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    /**
     * Get the payment method in Arabic.
     */
    public function getPaymentMethodArabicAttribute()
    {
        $paymentMap = [
            'COD' => 'الدفع عند الاستلام',
            'credit_card' => 'بطاقة ائتمان',
        ];

        return $paymentMap[$this->payment_method] ?? $this->payment_method;
    }

    /**
     * Get the total items quantity.
     */
    public function getTotalItemsAttribute()
    {
        return $this->orderItems()->sum('quantity');
    }

    /**
     * Scope for filtering by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for recent orders.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}