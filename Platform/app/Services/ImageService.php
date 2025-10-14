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
        $manager = new ImageManager(new Driver());

        $img = $manager->read($image->getRealPath());

        $webpImage = $img->toWebp(80);

        $filename = uniqid() . '.webp';
        $path = 'images/ProductImages/' . $filename;

        Storage::disk('public')->put($path, (string) $webpImage);

        return $path;
    }

    public function deleteImage($imageurl){
        Storage::disk('public')->delete($imageurl);
    }
}
