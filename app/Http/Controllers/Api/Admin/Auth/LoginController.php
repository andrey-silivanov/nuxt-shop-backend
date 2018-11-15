<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return response()->json(['adasd' => '1']);
    }
}
