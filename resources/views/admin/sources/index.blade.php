@extends('layouts.admin')
@section('title') Sources @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Источники новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.sources.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить источник новостей</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Source</th>
                <th>Url</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
            @foreach($sourcesList as $source)
                <tr>
                    <td>{{ $source->id }}</td>
                    <td>{{ $source->title }}</td>
                    <td>{{ $source->url }}</td>
                    <td>{{ $source->created_at }}</td>
                    <td><a href="{{ route('admin.sources.edit', ['source' => $source]) }}">Edit</a>&nbsp; <a href="" style="color:red">Delete</a></td>
                </tr>
            @endforeach
        </table>
        {{ $sourcesList->links() }}
    </div>
@endsection
