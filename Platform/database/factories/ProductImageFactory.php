<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'main_url' => $this->faker->imageUrl(800, 800, 'product'),
            'opt_url' => $this->faker->imageUrl(800, 800, 'product'),
            'opt2_url' => null,
            'opt3_url' => null,
        ];
    }
}
