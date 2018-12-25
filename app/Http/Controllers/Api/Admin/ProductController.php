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

        if ($request->get('search')) {
            $productBuilder = ProductGroups::whereHas('products', function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->get('search')}%");
            });
        }

        /*if ($request->get('categoryId')) {
            $category = Category::findOrFail($request->get('categoryId'));
            if ($category->isParent()) {
                $categoryIds = $category->children->pluck('id')->toArray();    ///  or category_id

            } else {
                $categoryIds = array($category->getKey());
               // return $categoryIds;
            }
            $productBuilder->whereHas('category', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);                           /// or category_id
            });
        }*/

        $products = $productBuilder
            //->with('products')
        ->paginate(20);
        
        return $this->successResponse(
            $this->transformDataForResponse(ProductResource::collection($products)), 'success');
    }

    public function import()
    {
        ImportProducts::dispatch();
    }

}
