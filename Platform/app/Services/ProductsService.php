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


    public function getProductsByBrand($brand_id, ?int $limit = null){
        if($limit === null){
            return Product::with('variants')->where('brand_id', $brand_id)->get();
        }
        else{
            return Product::where('brand_id', $brand_id)->limit($limit)->get();
        }
    }

    public function makeSKU($name, $categorie, $brand){
        $sku = strtoupper(substr($name, 0, 3)) . '-' .
        strtoupper(substr($categorie, 0, 3)) . '-' .
        strtoupper(substr($brand, 0, 3));
        return $sku;
    }

    public function createProduct($data){

        try{
            $this->makeSKU($data['Name'], $data['category_id'], $data['brand_id']);
        }
        catch(\Exception $e){
            throw new \Exception("Error generating SKU: " . $e->getMessage());
        }

         if (!isset($data['is_published'])) {
             $data['is_published'] = false;
         }

        validator($data, [
            'Name'          => 'required|string|max:255',
            'Description'   => 'nullable|string',
            'price'         => 'required|numeric|min:0',
            'category_id'   => 'required|exists:categories,id',
            'brand_id'      => 'required|exists:brands,id',
            'is_published'  => 'boolean',
            'SKU'           => 'required|string|max:50|unique:products,SKU',
        ],
        )->validate();

        $product = Product::create($data);

        if( !empty($data['variants'])) {
            foreach($data['variants'] as $variant){

            }
        }
    }

    public function createProductVariant($product_id, $variantData, ?bool $published, ?array $images){
        try{
            $this->makeSKU($variantData['name'], $variantData['category_id'], $variantData['brand_id']);
        }
        catch(\Exception $e){
            throw new \Exception("Error generating SKU: " . $e->getMessage());
        }

        if (!$published) {
             $published= false;
         }

        validator($variantData, [
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'Description'   => 'nullable|string',
            'SKU'   => 'required|string|max:50|unique:product_variants,SKU',
            'is_published' => 'boolean',
            'product_id' => 'required|exists:products,id',
        ])->validate();


        $product = Product::findOrFail($product_id);

        $variant = $product->variants()->create([
            'name' => $variantData['name'],
            'price' => $variantData['price'],
            'SKU' => $variantData['SKU'],
            'is_published' => $published,
            'Description' => $variantData['Description'] ?? null,
            'product_id' => $product_id,
        ]);
    }
}



