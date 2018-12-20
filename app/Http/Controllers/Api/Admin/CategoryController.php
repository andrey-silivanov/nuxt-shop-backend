<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function fetch()
    {
        return $this->successResponse(
            $this->transformDataForResponse(CategoryResource::collection(Category::all())), 'success');
    }

    public function getParent()
    {
        return $this->successResponse(
            $this->transformDataForResponse(CategoryResource::collection(Category::getParent()->get())), 'success');
    }

    public function getChildren(Category $category)
    {
        return $this->successResponse(
            $this->transformDataForResponse(CategoryResource::collection($category->children)), 'success');
    }
}
