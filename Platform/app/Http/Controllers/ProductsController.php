<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index($id){
        $product = Product::with('brand','category','productImage')->find($id);
        return view('marketplace.products.index', [
            'product' => $product
        ]);
    }
}
