<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Orders\Store;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class OrdersController extends Controller
{
    public function create(): View
    {
        return view('orders.create',
            ['users' => User::query()->get()->all()]);
    }

    public function store(Store $request): RedirectResponse
    {
        $order = Order::create($request->validated());
        if ($order !== false) {
            return \redirect()->route('index')->with('success', 'Order has been create');
        }
        return \back()->with('error', 'Order has not been create');
    }
}
