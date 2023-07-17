@extends('layouts.admin')
@section('title') Users @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Пользователи</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить пользователя</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        @include('admin.message')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>isAdmin</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
            @foreach($usersList as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->isAdmin }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><a href="{{ route('admin.users.edit', ['user' => $user]) }}">Edit</a>&nbsp;
                        <a href="javascript:;" style="color:red" class="delete" rel="{{ $user->id }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
        {{ $usersList->links() }}
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
                        send(`/admin/users/${id}`).then( () => {
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
