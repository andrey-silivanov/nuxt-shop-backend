<?php
declare (strict_type = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Admin\ProductGroupResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductGroups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return $this->successResponse(
            $this->transformDataForResponse(ProductGroupResource::collection(ProductGroups::paginate(20))), 'success');
    }
}
