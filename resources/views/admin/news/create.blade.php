@extends('layouts.admin')
@section('title') Add News @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить новость</h1>
    </div>

{{--    @if ($errors->any())--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            <x-alert type="danger" :message="$error" ></x-alert>--}}
{{--        @endforeach--}}
{{--    @endif--}}

    <form method="POST" action="{{route('admin.news.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="categories">Категории @error('categories') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <select class="form-control" multiple name="categories[]" id="categories" >
                @foreach($categories as $category)
                    <option @if(in_array($category->id, old('categories') ?? [])) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Заголовок @error('title') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="author">Автор @error('author') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="author" id="author" class="form-control" value="{{old('author')}}">
        </div>
        <div class="form-group">
            <label for="image">Изображение @error('img') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Статус @error('status') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <select class="form-control" name="status" id="ststus">
                <option @if(old('status') === 'draft') selected @endif value="{{ App\Enums\NewsStatus::DRAFT->value }}">DRAFT</option>
                <option @if(old('status') === 'active') selected @endif value="{{ App\Enums\NewsStatus::ACTIVE->value }}">ACTIVE</option>
                <option @if(old('status') === 'blocked') selected @endif value="{{ App\Enums\NewsStatus::BLOCKED->value }}">BLOCKED</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Описание @error('description') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label for="sources">Источники новостей  @error('sources') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <select class="form-control" multiple name="sources[]" id="sources" >
                @foreach($sources as $source)
                    <option @if(in_array($source->id, old('sources') ?? [])) selected @endif value="{{ $source->id }}">{{ $source->title }}</option>
                @endforeach
            </select>
        </div>
        <br />
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
