<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function order(): View
    {
        return view('users.order');
    }

    public function store(Request $request)
    {
        return response()->json($request->only(['user_name', 'user_phone', 'user_email', 'user_order']));
    }
}
