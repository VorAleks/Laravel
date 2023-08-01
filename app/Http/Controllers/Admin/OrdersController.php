<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\Store;
use App\Http\Requests\Orders\Update;
use App\Models\Order;
use App\Queries\OrdersQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

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
            'ordersList' => $this->ordersQueryBuilder->getAllPaginate()
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
    public function store(Store $request): RedirectResponse
    {
        $order = Order::create($request->validated());
        if ($order) {
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
    public function update(Update $request, Order $order): RedirectResponse
    {
        $order = $order->fill($request->validated());
        if ($order->save()) {
            return \redirect()->route('admin.orders.index')->with('success', 'Order has been update');
        }
        return \back()->with('error', 'Order has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        try {
            $order->delete();

            return \response()->json('ok');
        } catch (\Throwable $exception) {
            \log::error($exception->getMessage(), $exception->getTrace());

            return \response()->json('error', 400);
        }
    }
}
