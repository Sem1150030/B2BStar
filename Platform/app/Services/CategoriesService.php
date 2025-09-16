<?php
namespace App\Services;

use App\Models\Category;

class CategoriesService
{
    public function getAllCategories()
    {
        return Category::all();
    }
}
