<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductDiscount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         Basic test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.coX',
            'password' => bcrypt('password'), // password
        ]);

        // Guard against double seeding in production
        if (Brand::count() > 0) {
            return; // already seeded
        }

        // Create (or ensure) a curated list of marketplace categories
        $categoryNames = [
            'Electronics' => 'Electronics.jpeg',
            'Computers & Accessories' => 'COMPUTERS.jpeg',
            'Smartphones & Tablets' => 'Phones.jpeg',
            'Home & Kitchen' => 'Kitchen.jpeg',
            'Furniture' => 'Furniture.jpeg',
            'Health & Personal Care' => 'health.jpeg',
            'Beauty & Grooming' => 'This elegant grooming set includes everything he….jpeg',
            'Sports & Outdoors' => 'Sports.jpeg',
            'Fitness & Training' => 'Sports.jpeg',
            'Toys & Games' => 'Toys.jpeg',
            'Baby & Kids' => '13923f69-b33b-4239-bd6d-160a5e6a2a3e.jpeg',
            'Fashion & Apparel' => 'Flickr.jpeg',
            'Shoes & Footwear' => 'Flickr.jpeg',
            'Jewelry & Watches' => 'Watch.jpeg',
            'Books & Media' => 'Books.jpeg',
            'Office & Stationery' => 'Office.jpeg',
            'Pet Supplies' => 'PetSupplies.jpeg',
            'Automotive' => 'Automotive.jpeg',
            'Tools & Home Improvement' => 'Furniture.jpeg',
            'Garden & Outdoor' => 'Garden.jpeg',
            'Groceries & Gourmet' => 'Gourmet.jpeg',
            'Arts & Crafts' => 'Arts&Crafts.jpeg',
            'Music Instruments' => 'Instrument.jpeg',
            'Travel & Luggage' => 'Travel.jpeg',
            'Industrial & Scientific' => 'Scientific.jpeg',
        ];

        $categories = collect($categoryNames)->map(function (string $imagePath, string $name) {
            return Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => $name . ' category',
                    'image_path' => $imagePath
                ]
            );
        });

    // Create brands with nested products & variants
        Brand::factory()
            ->count(5)
            ->create()
            ->each(function (Brand $brand) {
                Product::factory()
                    ->count(5)
                    ->create(['brand_id' => $brand->id])
                    ->each(function (Product $product) {
            // Random category assignment
            $randomCategory = \App\Models\Category::inRandomOrder()->first();
            $product->update(['category_id' => $randomCategory?->id]);
                        // Decide number of variants
                        $variantCount = $product->has_multiple_variants ? rand(2,4) : 1;
                        ProductVariant::factory()
                            ->count($variantCount)
                            ->create(['product_id' => $product->id])
                            ->each(function (ProductVariant $variant) {
                                // Images - using polymorphic relationship
                                ProductImage::factory()->count(1)->create([
                                    'imageable_type' => ProductVariant::class,
                                    'imageable_id' => $variant->id,
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
