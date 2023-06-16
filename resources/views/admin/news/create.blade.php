@extends('layouts.admin')
@section('title') Add News @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить новость</h1>
    </div>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error" ></x-alert>
        @endforeach
    @endif

    <form method="POST" action="{{route('admin.news.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" class="form-control" value="{{old('author')}}">
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="ststus">
                <option @if(old('status') === 'DRAFT') selected @endif>DRAFT</option>
                <option @if(old('status') === 'ACTIVE') selected @endif>ACTIVE</option>
                <option @if(old('status') === 'BLOCKED') selected @endif>BLOCKED</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
        </div>
        <br />
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
