@extends('layouts.admin')
@section('title') News @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Новости</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить новость</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
@include('admin.message')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Categories</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Source</th>
                <th>Actions</th>
            </tr>
            @foreach($newsList as $news)
                <tr>
                    <td>{{ $news->id }}</td>
                    <td>{{ $news->categories->map(fn($item)=> $item->title)->implode(" | ") }}</td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->author }}</td>
                    <td>{{ $news->status }}</td>
                    <td>{{ $news->created_at }}</td>
                    <td>{{ $news->sources->map(fn($item)=> $item->title)->implode(" | ") }}</td>
                    <td><a href="{{ route('admin.news.edit', ['news' => $news]) }}">Edit</a>&nbsp;
                        <a href="javascript:;" style="color:red" class="delete" rel="{{ $news->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $newsList->links() }}
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            let elements = document.querySelectorAll('.delete');
            elements.forEach(function (element, key) {
                element.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if (confirm(`Подтвердите удаление записи с #ID = ${id}`)) {
                        send(`/admin/news/${id}`).then( () => {
                           location.reload();
                        });
                    } else {
                        alert("Вы отменили удаление записи")
                    }
                });
            })
        });

        async function send(url) {
            let response = await  fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
