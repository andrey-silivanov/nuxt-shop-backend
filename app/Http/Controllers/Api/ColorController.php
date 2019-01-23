<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\ColorResource,
    App\Models\Color,
    Illuminate\Http\JsonResponse,
    App\Http\Controllers\Controller;

/**
 * Class ColorController
 * @package App\Http\Controllers\Api
 */
class ColorController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function fetch():JsonResponse
    {
        return $this->successResponse(
            $this->transformDataForResponse(ColorResource::collection(Color::all())), 'success');
    }
}
