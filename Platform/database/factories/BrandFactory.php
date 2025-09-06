<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'finance_email' => $this->faker->companyEmail(),
            'role_id' => null,
            'motto' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
