<?php

namespace App\Livewire\Marketplace\Products;

use App\Models\Product;
use Livewire\Component;

class ProductDetailsComponent extends Component
{
    public Product $product;

    public function mount($product){
        // The product is already loaded with relationships from the controller
        // Just ensure we have all needed relationships loaded
        if ($product instanceof Product) {
            $this->product = $product->load([
                'brand',
                'category',
                'variants' => function($query) {
                    $query->orderBy('position');
                },
                'productImage'
            ]);
        } else {
            // If an ID is passed, fetch the product
            $this->product = Product::with([
                'brand',
                'category',
                'variants' => function($query) {
                    $query->orderBy('position');
                },
                'productImage'
            ])->findOrFail($product);
        }
    }

    public function render()
    {
        return view('livewire.marketplace.products.product-details-component');
    }
}
