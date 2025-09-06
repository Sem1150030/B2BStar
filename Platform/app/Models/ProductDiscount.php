<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDiscount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_variant_id', 'discount_percentage', 'discount_amount', 'has_percentage', 'from_datetime', 'until_datetime', 'is_active'
    ];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'has_percentage' => 'boolean',
        'is_active' => 'boolean',
        'from_datetime' => 'datetime',
        'until_datetime' => 'datetime',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('from_datetime', '<=', now())
            ->where(function ($q) {
                $q->whereNull('until_datetime')->orWhere('until_datetime', '>=', now());
            });
    }
}
