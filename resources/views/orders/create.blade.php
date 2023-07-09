@extends('layouts.main')
@section('title') New order @parent @stop
@section('content')
    <div class="container">

{{--        @if ($errors->any())--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <x-alert type="danger" :message="$error" ></x-alert>--}}
{{--            @endforeach--}}
{{--        @endif--}}
        <section class="py-5 text-left container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Заказ на выгрузку данных</h1>

                    <form method="POST" action="{{route('orders.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Имя заказчика @error('name') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон @error('phone') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Е-мэйл @error('email') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание @error('description') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
                            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
