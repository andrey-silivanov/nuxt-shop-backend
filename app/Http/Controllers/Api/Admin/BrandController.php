<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends ApiController
{
    public function fetch()
    {
        return $this->successResponse(
            $this->transformDataForResponse(BrandResource::collection(Brand::all())), 'success');
    }
}
