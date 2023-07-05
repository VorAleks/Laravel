<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function App\Enums\all;

class OrdersController extends Controller
{
    public function create(): View
    {
        return view('orders.create',
            ['users' => User::query()->get()->all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
        ]);

        $order = $request->only(['name', 'phone', 'email', 'description']);
        $order = Order::create($order);
        if ($order !== false) {
            return \redirect()->route('index')->with('success', 'Order has been create');
        }
        return \back()->with('error', 'Order has not been create');
    }
}
