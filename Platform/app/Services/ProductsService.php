<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;


class ProductsService
{
    public function getProducts(?int $limit = null)
    {
        if ($limit === null) {
            return Product::all();
        } else {
            return Product::limit($limit)->get();
        }
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }


    public function getProductsByBrand($brand_id, ?int $limit = null)
    {
        if ($limit === null) {
            return Product::with(['variants', 'productImage'])->where('brand_id', $brand_id)->get();
        } else {
            return Product::with(['variants', 'productImage'])->where('brand_id', $brand_id)->limit($limit)->get();
        }
    }

    public function makeSKU($name, $categorie, $brand): string
    {
        return strtoupper(substr($name, 0, 3)) . '-' .
            strtoupper(substr($categorie, 0, 3)) . '-' .
            strtoupper(substr($brand, 0, 3));
    }

    public function storeProductImage($id, $model, $imagePath)
    {

        //TODO: handle auth
        if($imagePath){
            ProductImage::create([
               'main_url' => $imagePath,
               'imageable_id' => $id,
               'imageable_type' => $model,
            ]);
        }

    }

    /**
     * @throws \Throwable
     */
    public function createProduct(array $data): bool
    {
        try {
            $data['SKU'] = $this->makeSKU($data['name'], $data['category_id'], Auth::user()->role_id);
        } catch (\Exception $e) {
            throw new \Exception("Error generating SKU: " . $e->getMessage());
        }

        if (!isset($data['is_published'])) {
            $data['is_published'] = false;
        }

        $data['slug'] = \Str::slug($data['name'] . '-' . \Str::random(5));
        try {
            validator($data, [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'is_published' => 'boolean',
                'SKU' => 'required|string|max:50|unique:products,SKU',
                'slug' => 'nullable|string|max:255|unique:products,slug',
            ])->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        }

        $productData = collect($data)->only([
            'name',
            'description',
            'price',
            'category_id',
            'brand_id',
            'is_published',
            'SKU',
            'slug',
        ])->toArray();

        DB::transaction(function () use ($productData, $data) {
            $product = Product::create($productData);
            $this->storeProductImage($product->id, Product::class, $data['image']);

            if (!empty($data['variants']) && is_array($data['variants'])) {
                foreach ($data['variants'] as $variant) {
                    $this->createProductVariant($product->id, $variant, $productData['is_published'], $data['images'] ?? null);
                }
            }
        });

        return true;
    }

    public function createProductVariant($product_id, $variantData, ?bool $published, ?array $images)
    {
        try {
            $sku = $this->makeSKU($variantData['name'], $variantData['category_id'], $variantData['brand_id']);
        } catch (\Exception $e) {
            throw new \Exception("Error generating SKU: " . $e->getMessage());
        }

        if (!$published) {
            $published = false;
        }

        if (empty($sku) || strlen($sku) > 50) {
            throw new \Exception("Invalid SKU generated.");
        }
        if (ProductVariant::where('SKU', $sku)->exists()) {
            throw new \Exception("SKU already exists.");
        }

        validator($variantData, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'Description' => 'nullable|string',
            'is_published' => 'boolean',
            'product_id' => 'required|exists:products,id',
        ])->validate();


        $product = Product::findOrFail($product_id);

        $variant = $product->variants()->create([
            'name' => $variantData['name'],
            'price' => $variantData['price'],
            'SKU' => $sku,
            'is_published' => $published,
            'Description' => $variantData['Description'] ?? null,
            'product_id' => $product_id,
        ]);
    }
}
