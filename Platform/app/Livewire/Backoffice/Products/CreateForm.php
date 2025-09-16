<?php

namespace App\Livewire\Backoffice\Products;

use App\Services\ImageService;
use Livewire\Component;
use App\Services\CategoriesService;
use Livewire\WithFileUploads;


class CreateForm extends Component
{
    use WithFileUploads;

    public $categories;
    public $image;
    public $imagePath;

    public $name, $category, $is_published = false;
    public $variants = [];

    public function addVariant()
    {
        $this->variants[] = ['name' => '', 'price' => ''];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants); // reindex array
    }


    public function mount()
    {
        $this->categories = app(CategoriesService::class)->getAllCategories();
    }
    public function render()
    {
        return view('livewire.backoffice.products.create-form');
    }

    public function uploadImage(ImageService $service)
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);
        $this->imagePath = $service->uploadImage($this->image);

    }

    public function submitForm()
    {
        $this->uploadImage(app(ImageService::class));

    }




}
