@extends('layouts.main')
@section('title') News @parent @stop
@section('content')
<div class="container">
    <section class="py-0 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                @if($categories instanceof \Illuminate\Support\Collection)
                    <h1 class="fw-light">Все новости</h1>
                @else
                    <h1 class="fw-light">Новости: {{ $categories->title }}</h1>
                @endif
            </div>
        </div>
    </section>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse ($news as $newsItem)
        <div class="col">
            <div class="card shadow-sm">
                <img src="{{$newsItem->image}}"/>

                <div class="card-body">
                    <p>Рубрика: {{$newsItem->categoryTitle}}</p>
                    <p><strong><a href="{{ route('news.show', ['id' => $newsItem->id]) }}"><h2>{{$newsItem->title}}</h2></a></strong></p>
                    <p class="card-text">{{$newsItem->description}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                           <a href="{{ route('news.show', ['id' => $newsItem->id]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                        </div>
                        <small class="text-muted">{{$newsItem->author}} ({{$newsItem->created_at}})</small>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>Нет новостей</p>
        @endforelse
    </div>
</div>
@endsection







