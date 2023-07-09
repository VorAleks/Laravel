@extends('layouts.admin')
@section('title') Add source @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить источник новостей</h1>
    </div>

{{--    @if ($errors->any())--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            <x-alert type="danger" :message="$error" ></x-alert>--}}
{{--        @endforeach--}}
{{--    @endif--}}

    <form method="POST" action="{{route('admin.sources.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Заголовок @error('title') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="url">Ссылка @error('url') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="url" id="url" class="form-control" value="{{old('url')}}">
        </div>
        <br />
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
