<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Queries\OrdersQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrdersController extends Controller
{
    protected QueryBuilder $ordersQueryBuilder;

    public function __construct(
        OrdersQueryBuilder $ordersQueryBuilder,
    )
    {
        $this->ordersQueryBuilder = $ordersQueryBuilder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.orders.index', [
            'ordersList' => $this->ordersQueryBuilder->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
        ]);

        $order = $request->only(['name', 'phone', 'email', 'description']);
        $order = Order::create($order);
        if ($order !== false) {
            return \redirect()->route('admin.orders.index')->with('success', 'Order has been create');
        }
        return \back()->with('error', 'Order has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        return \view('admin.orders.edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $order = $order->fill($request->only(['name', 'phone', 'email', 'description']));
        if ($order->save()) {
            return \redirect()->route('admin.orders.index')->with('success', 'Order has been update');
        }
        return \back()->with('error', 'Order has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
