@extends('layouts.main')
@section('title')News "{{ $newsItem['title'] }}" @parent @stop
@section('content')
    <div class="container">
{{--        <h1>News</h1>--}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
{{--            @forelse ($news as $newsItem)--}}
{{--                @foreach ($categories as $item)--}}
{{--                    @if ($item['id'] == $newsItem['category_id'])--}}
<!--                        --><?php //$category = $item['title']; ?>
{{--                    @endif--}}
{{--                @endforeach--}}
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                        <div class="card-body">
{{--                            <p>Рубрика: {{$category}}</p>--}}
                            <h2>{{$newsItem['title']}}</h2>
                            <p class="card-text">{{$newsItem['description']}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
{{--                                    <a href="/news/{{$newsItem['id']}}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>--}}
                                </div>
                                <small class="text-muted">{{$newsItem['author']}} ({{$newsItem['created_at']}})</small>
                            </div>
                        </div>
                    </div>
                </div>
{{--            @empty--}}
{{--                <p>Нет новостей</p>--}}
{{--            @endforelse--}}
        </div>
    </div>
@endsection

