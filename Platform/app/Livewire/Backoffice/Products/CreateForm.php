<?php

namespace App\Livewire\Backoffice\Products;

use App\Http\Controllers\BackofficeController;
use App\Services\ImageService;
use App\Services\ProductsService;
use Livewire\Component;
use App\Services\CategoriesService;
use Livewire\WithFileUploads;

class CreateForm extends Component
{
    use WithFileUploads;
    public $categories;
    public $image;

    public $optionalImages = [null, null, null];
    public $imagePath;

    public $description;
    public float $price;

    public int $category;

    public $name, $is_published = false;
    public $variants = [];

    public function addVariant()
    {
        $this->variants[] = ['name' => '', 'price' => 0, 'image' => null, 'description' => null, 'optionalImages' => [null, null, null]];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function mount()
    {
        $this->categories = app(CategoriesService::class)->getAllCategories();
    }

    public function uploadImage(ImageService $service, $imageFile)
    {
        $this->validate([
            'image' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);
        return $service->uploadImageProduct($imageFile);
    }

    public function store(): void
    {
        $service = app(ImageService::class);
        $mainImagePath = null;
        if ($this->image) {
            $mainImagePath = $this->uploadImage($service, $this->image);
            //TODO: Safe image
        }

        // Handle optional images
        $optionalImagePaths = [];
        foreach ($this->optionalImages as $optionalImage) {
            if ($optionalImage) {
                $optionalImagePaths[] = $this->uploadImage($service, $optionalImage);
            }
        }

        $variantsWithImages = [];
        foreach ($this->variants as $variant) {
            $variantImagePath = null;
            if (!empty($variant['image'])) {
                $variantImagePath = $this->uploadImage($service, $variant['image']);
            }

            $variantOptionalImagePaths = [];
            if (!empty($variant['optionalImages'])) {
                foreach ($variant['optionalImages'] as $variantOptionalImage) {
                    if ($variantOptionalImage) {
                        $variantOptionalImagePaths[] = $this->uploadImage($service, $variantOptionalImage);
                    }
                }
            }

            $variantsWithImages[] = [
                'name' => $variant['name'],
                'price' => $variant['price'],
                'image' => $variantImagePath,
                'optional_images' => $variantOptionalImagePaths,
                'description' => $variant['description'] ?? null,
            ];
        }

        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category,
            'is_published' => $this->is_published,
            'variants' => $variantsWithImages,
            'image' => $mainImagePath,
            'optional_images' => $optionalImagePaths,
            'description' => $this->description,
            'brand_id' => auth()->user()->role_id,
        ];

        try {
            app(BackofficeController::class)->storeProduct($data);
            session()->flash('success', 'Product created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.backoffice.products.create-form');
    }
}
