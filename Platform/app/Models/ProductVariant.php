<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id', 'name', 'sku', 'description', 'price', 'is_published', 'position'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productImage()
    {
        return $this->morphOne(ProductImage::class, 'imageable');
    }

    public function discounts()
    {
        return $this->hasMany(ProductDiscount::class);
    }

    public function activeDiscount()
    {
        return $this->hasOne(ProductDiscount::class)
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('until_datetime')->orWhere('until_datetime', '>=', now());
            })
            ->where('from_datetime', '<=', now())
            ->latest('from_datetime');
    }

    public function getPriceAfterDiscountAttribute(): string
    {
        $discount = $this->activeDiscount()->first();
        if (!$discount) {
            return (string) $this->price;
        }
        $price = $this->price;
        if ($discount->has_percentage && $discount->discount_percentage) {
            $price = $price - ($price * ($discount->discount_percentage / 100));
        } elseif ($discount->discount_amount) {
            $price = $price - $discount->discount_amount;
        }
        return number_format(max($price, 0), 2, '.', '');
    }
}
