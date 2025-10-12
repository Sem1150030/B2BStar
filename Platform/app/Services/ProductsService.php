<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use function Livewire\store;


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
        $random = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
        return strtoupper(substr($name, 0, 3)) . '-' .
            strtoupper(substr($categorie, 0, 3)) . '-' .
            strtoupper(substr($brand, 0, 3)) . '-' . $random;
    }

    public function storeProductImage($id, $model, $imagePath)
    {

        //TODO: handle auth
        if($imagePath){
            return ProductImage::create([
               'main_url' => $imagePath,
               'imageable_id' => $id,
               'imageable_type' => $model,
            ]);
        }
        return null;
    }

    public function storeOptionalImages(ProductImage $productImage, $imagePaths = [])
    {
        if($imagePaths)
        {
            $i = 1;
            foreach($imagePaths as $imagePath) {
                if($i > 3) break;
                $key = $i == 1 ? 'opt_url' : 'opt' . $i . '_url';

                $productImage->$key = $imagePath;
                $i++;
                dump($i);
            }
            $productImage->save();
        }
        return true;
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

        try {
            DB::transaction(function () use ($productData, $data) {
                $product = Product::create($productData);

                if (isset($data['image'])) {
                    $productImage = $this->storeProductImage($product->id, Product::class, $data['image']);

                    if ($productImage && isset($data['optional_images'])){
                        $this->storeOptionalImages($productImage, $data['optional_images']);
                    }

                }



                if (!empty($data['variants']) && is_array($data['variants'])) {
                    foreach ($data['variants'] as $variant) {
                        $this->createProductVariant($variant, $product);
                    }
                }
            });
        } catch (\Exception $e) {
            throw new \Exception("Error creating product: " . $e->getMessage());
        }

        return true;
    }

    public function createProductVariant($variantData, $product)
    {
        try {
            $sku = $this->makeSKU($variantData['name'], $product->category_id, Auth::User()->role_id);
        } catch (\Exception $e) {
            throw new \Exception("Error generating variant SKU: " . $e->getMessage());
        }

        if (empty($sku) || strlen($sku) > 50) {
            throw new \Exception("Invalid SKU generated for variant.");
        }

        if (ProductVariant::where('sku', $sku)->exists()) {
            throw new \Exception("SKU already exists for variant: " . $sku);
        }

        // Validate variant data
        $validatedData = validator($variantData, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'image' => 'nullable|string|max:255',
        ])->validate();

        // Create the variant
        $variant = $product->variants()->create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'sku' => $sku,
            'is_published' => $validatedData['is_published'] ?? false,
            'description' => $validatedData['description'] ?? null,
        ]);

        // Store variant image if provided
        if (isset($validatedData['image']) && !empty($validatedData['image'])) {
            $productImage = $this->storeProductImage($variant->id, ProductVariant::class, $validatedData['image']);

            if ($productImage && isset($variantData['optional_images'])){
                $this->storeOptionalImages($productImage, $variantData['optional_images']);
            }
        }

        return $variant;
    }
}
