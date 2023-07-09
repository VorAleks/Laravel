@extends('layouts.admin')
@section('title') Edit News @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать новость</h1>
    </div>

{{--    @if ($errors->any())--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            <x-alert type="danger" :message="$error" ></x-alert>--}}
{{--        @endforeach--}}
{{--    @endif--}}

    <form method="POST" action="{{route('admin.news.update', ['news' => $news])}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="categories">Категории @error('categories') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <select class="form-control" multiple name="categories[]" id="categories" >
                @foreach($categories as $category)
                    <option @if(in_array($category->id, $news->categories->pluck('id')->toArray())) selected @endif value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Заголовок @error('title') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}">
        </div>
        <div class="form-group">
            <label for="author">Автор @error('author') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ $news->author }}">
        </div>
        <div class="form-group">
            <label for="image">Изображение @error('img') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Статус @error('status') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <select class="form-control" name="status" id="ststus">
                <option @if($news->status === 'draft') selected @endif value="{{ App\Enums\NewsStatus::DRAFT->value }}">DRAFT</option>
                <option @if($news->status === 'active') selected @endif value="{{ App\Enums\NewsStatus::ACTIVE->value }}">ACTIVE</option>
                <option @if($news->status === 'blocked') selected @endif value="{{ App\Enums\NewsStatus::BLOCKED->value }}">BLOCKED</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Описание @error('description') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <textarea name="description" id="description" class="form-control">{{$news->description}}</textarea>
        </div>
        <br />
        <div class="form-group">
            <label for="categories">Источник новостей @error('sources') <strong STYLE="color:red">{{ $message }}</strong> @enderror</label>
            <select class="form-control" multiple name="sources[]" id="sources" >
                @foreach($sources as $source)
                    <option @if(in_array($source->id, $news->sources->pluck('id')->toArray())) selected @endif value="{{ $source->id }}">
                        {{ $source->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
