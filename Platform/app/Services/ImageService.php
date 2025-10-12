<?php
namespace App\Services;

use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImageService
{
    use WithFileUploads;

    public function uploadImageProduct($image)
    {
        // Create image manager instance with GD driver
        $manager = new ImageManager(new Driver());

        // Read and process the image
        $img = $manager->read($image->getRealPath());

        // Convert to WebP format with compression (quality 80)
        $webpImage = $img->toWebp(80);

        // Generate unique filename
        $filename = uniqid() . '.webp';
        $path = 'images/ProductImages/' . $filename;

        // Store the WebP image
        Storage::disk('public')->put($path, (string) $webpImage);

        return $path;
    }
}
