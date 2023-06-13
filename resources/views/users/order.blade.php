@extends('layouts.main')
@section('title') New order @parent @stop
@section('content')
    <div class="container">

        @if ($errors->any())
            @foreach($errors->all() as $error)
                <x-alert type="danger" :message="$error" ></x-alert>
            @endforeach
        @endif
        <section class="py-5 text-left container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Заказ на выгрузку данных</h1>
                    <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="user_name">Имя заказчика</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" value="{{old('user_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="user_phone">Телефон</label>
                            <input type="text" name="user_phone" id="user_phone" class="form-control" value="{{old('user_phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Адрес электронной почты</label>
                            <input type="email" name="user_email" id="user_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_order">Описание заказа</label>
                            <textarea name="user_order" id="user_order" class="form-control">{{old('user_order')}}</textarea>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
