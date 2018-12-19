<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getAll()
    {
        return $this->successResponse(
            $this->transformDataForResponse(CategoryResource::collection(Category::all())), 'success');
    }
}
