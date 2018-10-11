<?php
declare (strict_type = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return $this->successResponse(
            $this->transformDataForResponse(ProductResource::collection(Product::all())), 'success');
    }
}
