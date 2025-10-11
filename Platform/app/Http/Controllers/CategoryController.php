<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

    }

    public function show($id){
        $category = Category::with('products.productImage')->find($id);
        return view('marketplace.categories.show', [
            'category' => $category
        ]);
    }
}
