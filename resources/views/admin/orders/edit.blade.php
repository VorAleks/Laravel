@extends('layouts.admin')
@section('title') Edit order @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать заказ на выгрузку</h1>
    </div>

{{--    @if ($errors->any())--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            <x-alert type="danger" :message="$error" ></x-alert>--}}
{{--        @endforeach--}}
{{--    @endif--}}

    <form method="POST" action="{{route('admin.orders.update', ['order' => $order])}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Имя @error('name') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$order->name}}">
        </div>
        <div class="form-group">
            <label for="phone">Телефон @error('phone') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{$order->phone}}">
        </div>
        <div class="form-group">
            <label for="email">Е-мэйл @error('mail') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="email" id="email" class="form-control" value="{{$order->email}}">
        </div>
        <div class="form-group">
            <label for="description">Описание @error('description') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <textarea name="description" id="description" class="form-control">{{$order->description}}</textarea>
        </div>
        <br />
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
