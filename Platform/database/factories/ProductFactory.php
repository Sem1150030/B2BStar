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
            'name' => ucfirst($name),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'has_multiple_variants' => $this->faker->boolean(),
            'is_published' => true,
            'published_at' => now(),
            'slug' => Str::slug($name.'-'.Str::random(5)),
            'SKU' => 'SKU-' . Str::random(8),
        ];
    }
}
