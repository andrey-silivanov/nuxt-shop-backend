<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\ProductResource;
use App\Jobs\ImportProducts;
use App\Models\Product;
use App\Models\ProductGroups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function fetch()
    {
        return $this->successResponse(
            $this->transformDataForResponse(ProductResource::collection(ProductGroups::with('products')->paginate(20))), 'success');
    }

    public function import()
    {
        ImportProducts::dispatch();
    }

}
