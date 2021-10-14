<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $productIds = collect($request->get('products'))->pluck('id');

        $products = Product::find($productIds);

        return response()->json(['s' => $products]);
    }
}
