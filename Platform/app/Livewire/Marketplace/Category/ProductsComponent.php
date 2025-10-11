<?php

namespace App\Livewire\Marketplace\Category;

use App\Models\Product;
use Livewire\Component;

class ProductsComponent extends Component
{
    public Product $products;

    public int $categoryId;

    public function mount($categoryId){
        $this->products = Product::published()
            ->category($categoryId)
            ->get();
    }

    public function render()
    {
        return view('livewire.marketplace.category.products-component');
    }
}
