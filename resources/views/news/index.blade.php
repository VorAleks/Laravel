@extends('layouts.main')
@section('title') News @parent @stop
@section('content')
<div class="container">
    <section class="py-0 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                @if(count($categories) > 1)
                    <h1 class="fw-light">Все новости</h1>
                @else
                    <h1 class="fw-light">Новости: {{ $categories[0]['title'] }}</h1>
                @endif
            </div>
        </div>
    </section>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse ($news as $newsItem)
            @foreach ($categories as $item)
                @if ($item['id'] === $newsItem['category_id'])
                    <?php $category = $item['title']; ?>
                @endif
            @endforeach
        <div class="col">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                <div class="card-body">
                    <p>Рубрика: {{$category}}</p>
                    <p><strong><a href="{{ route('news.show', ['id' => $newsItem['id']]) }}"><h2>{{$newsItem['title']}}</h2></a></strong></p>
                    <p class="card-text">{{$newsItem['description']}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                           <a href="{{ route('news.show', ['id' => $newsItem['id']]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                        </div>
                        <small class="text-muted">{{$newsItem['author']}} ({{$newsItem['created_at']}})</small>
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







