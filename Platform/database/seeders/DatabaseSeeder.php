<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductDiscount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Basic test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Guard against double seeding in production
        if (Brand::count() > 0) {
            return; // already seeded
        }

        // Create brands with nested products & variants
        Brand::factory()
            ->count(5)
            ->create()
            ->each(function (Brand $brand) {
                Product::factory()
                    ->count(3)
                    ->create(['brand_id' => $brand->id])
                    ->each(function (Product $product) {
                        // Decide number of variants
                        $variantCount = $product->has_multiple_variants ? rand(2,4) : 1;
                        ProductVariant::factory()
                            ->count($variantCount)
                            ->create(['product_id' => $product->id])
                            ->each(function (ProductVariant $variant) {
                                // Images
                                ProductImage::factory()->count(1)->create([
                                    'product_variant_id' => $variant->id,
                                ]);

                                // Optional discount (~50% chance)
                                if (rand(0,1)) {
                                    ProductDiscount::factory()->create([
                                        'product_variant_id' => $variant->id,
                                    ]);
                                }
                            });
                    });
            });
    }
}
