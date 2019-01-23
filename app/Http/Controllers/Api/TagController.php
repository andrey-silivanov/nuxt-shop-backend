<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\TagResource,
    App\Models\Tag,
    Illuminate\Http\JsonResponse,
    App\Http\Controllers\Controller;

/**
 * Class TagController
 * @package App\Http\Controllers\Api
 */
class TagController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function fetch():JsonResponse
    {
        return $this->successResponse(
            $this->transformDataForResponse(TagResource::collection(Tag::all())), 'success');
    }
}
