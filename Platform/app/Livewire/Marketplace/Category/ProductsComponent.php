<?php

namespace App\Livewire\Marketplace\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductsComponent extends Component
{
    public $products;

    public Category $category;

    public function mount($category){
        $this->category = $category;
        $this->products = $category->products;
    }

    public function render()
    {
        return view('livewire.marketplace.category.products-component');
    }
}
