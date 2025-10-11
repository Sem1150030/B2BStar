<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'brand_id',
        'is_published',
        'SKU',
        'slug',
    ];

    protected $casts = [
        'has_multiple_variants' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];



    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImage()
    {
        return $this->morphOne(ProductImage::class, 'imageable');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

}
