@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Точка входа для Админа</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('index') }}" type="button" class="btn btn-sm btn-outline-secondary">Переход на главную страницу</a>
            </div>

        </div>
    </div>
@endsection


