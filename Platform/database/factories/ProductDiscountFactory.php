<?php

namespace Database\Factories;

use App\Models\ProductDiscount;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDiscountFactory extends Factory
{
    protected $model = ProductDiscount::class;

    public function definition(): array
    {
        $hasPercentage = $this->faker->boolean();
        return [
            'product_variant_id' => ProductVariant::factory(),
            'discount_percentage' => $hasPercentage ? $this->faker->randomFloat(2, 5, 50) : null,
            'discount_amount' => $hasPercentage ? null : $this->faker->randomFloat(2, 1, 30),
            'has_percentage' => $hasPercentage,
            'from_datetime' => now()->subDays(1),
            'until_datetime' => now()->addDays(7),
            'is_active' => true,
        ];
    }
}
