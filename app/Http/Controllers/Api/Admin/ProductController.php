<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\ProductGroupResource;
use App\Http\Resources\Admin\ProductResource;
use App\Jobs\ImportProducts;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ProductController
 * @package App\Http\Controllers\Api\Admin
 */
class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetch(Request $request): JsonResponse
    {
        $productBuilder = Product::query();

        if ($request->get('phoneModelId')) {
            $productBuilder->wherePhoneModelId($request->get('phoneModelId'));
        }

        if ($request->get('categoryId')) {
            $productBuilder->whereCategoryId($request->get('categoryId'));
        }

        if ($request->get('search')) {
            $productBuilder->where('name', 'LIKE', "%{$request->get('search')}%");
        }

        return $this->successResponse(
            $this->transformDataForResponse(
                ProductResource::collection($productBuilder->paginate(20))), 'success');
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return $this->successResponse(
            $this->transformDataForResponse(
                new ProductResource($product)), 'success');
    }
}
