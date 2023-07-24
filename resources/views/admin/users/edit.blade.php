@extends('layouts.admin')
@section('title') Add News @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать пользователя</h1>
    </div>

    {{--    @if ($errors->any())--}}
    {{--        @foreach($errors->all() as $error)--}}
    {{--            <x-alert type="danger" :message="$error" ></x-alert>--}}
    {{--        @endforeach--}}
    {{--    @endif--}}
    @include('admin.message')
    <form method="POST" action="{{route('admin.users.update', ['user' => $user])}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">{{ __('Name') }} @error('name') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="email">{{ __('Email Address') }} @error('email') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="{{$user->email}}" ">
        </div>
        <div class="form-group">
            <label for="password">{{ __('Password') }}@error('password') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }} @error('password-confirm') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="password" name="password-confirm" id="password-confirm" class="form-control" value="{{old('password-confirm')}}">
        </div>

        <div class="form-group">
            Admin:<br>
            @if($user->isAdmin)
                <input type="radio" class="form-check-input" name="isAdmin" checked value="1">&nbsp;Yes <br>
                <input type="radio" class="form-check-input" name="isAdmin" value="0">&nbsp;No <br>
                        @else
                <input type="radio" class="form-check-input" name="isAdmin"  value="1">&nbsp;Yes <br>
                <input type="radio" class="form-check-input" name="isAdmin" checked value="0">&nbsp;No <br>
            @endif
        </div>

        <br />
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
