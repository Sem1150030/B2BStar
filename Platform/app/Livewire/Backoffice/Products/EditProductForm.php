<?php

namespace App\Livewire\Backoffice\Products;

use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\ProductsController;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ImageService;
use App\Services\CategoriesService;
use App\Services\ProductsService;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Nette\Utils\Image;

class EditProductForm extends Component
{
    use WithFileUploads;

    public $product;
public $productId;
    public $categories;
    public $name;
    public $description;
    public $price;
    public $category;
    public $is_published;
    public $image;
    public $optional_images = [null, null, null];
    public $existingMainImage;
    public $existingOptionalImages = [];
    public $variants = [];
    public $existingVariants = [];

    public function mount($product)
    {

        $this->product = $product;
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category = $product->category_id;
        $this->is_published = $product->is_published;

        if ($product->productImage) {
            $this->existingMainImage = $product->productImage->main_url;
            $this->existingOptionalImages = [
                $product->productImage->opt_url ?? null,
                $product->productImage->opt2_url ?? null,
                $product->productImage->opt3_url ?? null,
            ];
        }

        foreach ($product->variants as $variant) {
            $variantData = [
                'id' => $variant->id,
                'name' => $variant->name,
                'price' => $variant->price,
                'description' => $variant->description,
                'image' => null,
                // Do not pre-fill optional_images for each variant
                'optional_images' => [null, null, null],
                'existingMainImage' => $variant->productImage ? $variant->productImage->main_url : null,
                'existingOptionalImages' => $variant->productImage ? [
                    $variant->productImage->opt_url,
                    $variant->productImage->opt2_url,
                    $variant->productImage->opt3_url,
                ] : [],
            ];
            $this->existingVariants[] = $variantData;
        }
    $this->categories = app(CategoriesService::class)->getAllCategories();
    }

    public function deleteVariant(ProductVariant $variant){
        try {
            route('backoffice.products_variant.delete', ['id', $variant->id]);
            session()->flash('success', 'Variant deleted successfully.');
        }catch (
            \Exception $e
        ){
            session()->flash('error', 'Error deleting variant: ' . $e->getMessage());
        }
    }

    public function update(){
        try {

        App(BackofficeController::class)->updateProduct([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category,
                'is_published' => $this->is_published,
                'image' => $this->image,
                'optional_images' => $this->optional_images,
                'variants' => $this->variants,
                'existing_variants' => $this->existingVariants,
            ], $this->productId);

            //TODO: Update product_variant
            session()->flash('success', 'Product Updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating product: ' . $e->getMessage());
        }

    }

    public function addVariant()
    {
        $this->variants[] = ['name' => '', 'price' => 0, 'image' => null, 'description' => null, 'optional_images' => [null, null, null]];
}

    public function removeNewVariant($index)
    {
        unset($this->variants[$index]);
$this->variants = array_values($this->variants);
    }

    public function removeVariant($index)
    {
        unset($this->existingVariants[$index]);
        $this->existingVariants = array_values($this->existingVariants);
    }

    public function render()
    {
        return view('livewire.backoffice.products.edit-product-form', [
            'categories' => $this->categories,
        ]);
    }
}
