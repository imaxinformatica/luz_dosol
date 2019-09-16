<?php 

namespace App\Services;

use App\Category;

class ServiceCategory
{
    public function createCategory(array $data): void
    {
        Category::create($data);
    }

    public function updateCategory(array $data, Category $category): void
    {
        $category->update($data);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }

    
}