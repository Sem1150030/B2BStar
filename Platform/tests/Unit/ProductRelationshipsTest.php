<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_brand_and_variants_relationships(): void
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->for($brand)->create();
        $variant = ProductVariant::factory()->for($product)->create();

        $this->assertTrue($product->brand->is($brand));
        $this->assertTrue($variant->product->is($product));
        $this->assertEquals(1, $product->variants()->count());
    }
}
