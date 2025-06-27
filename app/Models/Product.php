<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the colors associated with the product.
     */
    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    /**
     * Get the sizes associated with the product.
     */
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    /**
     * Get the images associated with the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the order items associated with the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the first available color for the product.
     */
    public function getFirstColorAttribute()
    {
        return $this->colors->first()?->color;
    }

    /**
     * Get the first available size for the product.
     */
    public function getFirstSizeAttribute()
    {
        return $this->sizes->first()?->age;
    }

    /**
     * Get the main image or thumbnail for the product.
     */
    public function getMainImageAttribute()
    {
        if ($this->thumbnail) {
            return $this->thumbnail;
        }
        
        return $this->images->first()?->path ?? '/images/placeholder.jpg';
    }

    /**
     * Check if product is in stock.
     */
    public function getIsInStockAttribute()
    {
        return $this->stock > 0;
    }

    /**
     * Format price with currency.
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0) . 'دينار';
    }
}