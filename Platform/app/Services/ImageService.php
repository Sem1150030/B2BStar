<?php
namespace App\Services;

use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class ImageService
{

    use WithFileUploads;
    public function uploadImage($image)
    {
        $imagePath = $image->store('images', 'public');
        return $imagePath;
    }
}
