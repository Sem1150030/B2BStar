<?php

namespace App\Livewire\Backoffice\Products;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductsService;
use Auth;
use Livewire\Component;

class Table extends Component
{

    public $products;
    public $productsService = ProductsService::class;
    public function mount()
    {
        $this->products = app($this->productsService)->getProductsByBrand(Auth::user()->role_id);
    }

    public function render()
    {
        return view('livewire.backoffice.products.table');
    }
}
