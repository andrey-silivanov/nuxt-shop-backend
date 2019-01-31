<?php
declare (strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\{
    PhoneModels,
    Product
};
use Illuminate\Http\{
    JsonResponse,
    Request
};
use App\Http\Controllers\Controller,
    App\Http\Resources\ProductResource;

/**
 * Class ProductController
 * @package App\Http\Controllers\Api
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
        } else {
            $productBuilder->wherePhoneModelId(PhoneModels::first()->getKey());
        }

        if ($request->get('categoryId')) {
            $productBuilder->whereCategoryId($request->get('categoryId'));
        }

        if ($request->get('colorId')) {
            $productBuilder->whereColorId($request->get('colorId'));
        }

        if ($request->get('tagId')) {
            $productBuilder->whereTagId($request->get('tagId'));
        }

        if ($request->get('search')) {
            $productBuilder->where('name', 'LIKE', "%{$request->get('search')}%");
        }

        return $this->successResponse(
            $this->transformDataForResponse(
                ProductResource::collection($productBuilder->get())), 'success');
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
