<?php
declare (strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\PhoneModels;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
                ProductResource::collection($productBuilder->paginate(20))), 'success');
    }
}
