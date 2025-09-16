<?php
namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public function getProducts(?int $limit = null)
    {
        if($limit === null){
            return Product::all();
        }
        else{
            return Product::limit($limit)->get();
        }
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function createProduct(array $data)
    {

    }

    public function getProductsByBrand($brand_id, ?int $limit = null){
        if($limit === null){
            return Product::with('variants')->where('brand_id', $brand_id)->get();
        }
        else{
            return Product::where('brand_id', $brand_id)->limit($limit)->get();
        }
    }


}
