@extends('layouts.admin')
@section('title') Orders @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Заказы на выгрузку</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.orders.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить заказ</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Description</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
            @foreach($ordersList as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->description }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td><a href="{{ route('admin.orders.edit', ['order' => $order]) }}">Edit</a>&nbsp; <a href="" style="color:red">Delete</a></td>
                </tr>
            @endforeach
        </table>
        {{ $ordersList->links() }}
    </div>
@endsection

