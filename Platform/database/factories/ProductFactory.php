<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'brand_id' => Brand::factory(),
            'category' => $this->faker->randomElement(['general', 'apparel', 'electronics']),
            'has_multiple_variants' => $this->faker->boolean(),
            'is_published' => true,
            'published_at' => now(),
            'slug' => Str::slug($name.'-'.Str::random(5)),
        ];
    }
}
