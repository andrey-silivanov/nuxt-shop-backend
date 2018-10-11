<?php
declare (strict_type = 1);

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $p = Product::first();
        return response()->json(['sss' => $p->getFirstMediaUrl('products')]);
    }
}
