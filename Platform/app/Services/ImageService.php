<?php
namespace App\Services;

use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class ImageService
{
    use WithFileUploads;
    public function uploadImageProduct($image)
    {
        return $image->store('images/ProductImages', 'public');
    }
}
