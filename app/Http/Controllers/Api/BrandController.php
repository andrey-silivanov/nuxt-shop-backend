<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function fetch()
    {
        return $this->successResponse(
            $this->transformDataForResponse(BrandResource::collection(Brand::all())), 'success');
    }
}
