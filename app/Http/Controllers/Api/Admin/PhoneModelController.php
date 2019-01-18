<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\ModelResource;
use App\Models\PhoneModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneModelController extends Controller
{
    public function fetch(Request $request)
    {
        $phoneModels = PhoneModels::query();

        if ($request->has('brandId')) $phoneModels->whereBrandId($request->get('brandId'));

        return $this->successResponse(
            $this->transformDataForResponse(ModelResource::collection($phoneModels->get())), 'success');
    }
}
