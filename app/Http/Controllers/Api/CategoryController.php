<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource,
    App\Models\Category,
    Illuminate\Http\JsonResponse,
    App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function fetch(): JsonResponse
    {
        return $this->successResponse(
            $this->transformDataForResponse(CategoryResource::collection(Category::all())), 'success');
    }
}
