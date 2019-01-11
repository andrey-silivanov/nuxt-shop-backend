<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\ProductResource;
use App\Jobs\ImportProducts;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGroups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function fetch(Request $request)
    {
        $productBuilder = ProductGroups::query();

        if ($request->get('categoryId')) {
            $category = Category::findOrFail($request->get('categoryId'));
            if ($category->isParent()) {
                $categoryIds = $category->children->pluck('id')->toArray();    ///  or category_id

            } else {
                $categoryIds = array($category->getKey());
            }
            $productBuilder->whereHas('category', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);                           /// or category_id
            });
        }

        if ($request->get('search')) {
            $productBuilder->whereHas('products', function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->get('search')}%");
            });
        }
        
        return $this->successResponse(
            $this->transformDataForResponse(
                ProductResource::collection($productBuilder->paginate(20))), 'success');
    }

    public function show(ProductGroups $productGroups)
    {
        return $this->successResponse(
            $this->transformDataForResponse(
                new ProductResource($productGroups)), 'success');
    }

    public function import()
    {
        ImportProducts::dispatch();
    }

}
