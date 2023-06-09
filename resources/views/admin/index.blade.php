@extends('layouts.admin')
@section('title') Main @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Точка входа для Админа</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <x-alert :type="request()->get('type', 'success')" message="some message"></x-alert>
    <x-alert type="success" message="some message"></x-alert>
    <x-alert type="warning" message="some message"></x-alert>
    <x-alert type="info" message="some message"></x-alert>
    <x-alert type="danger" message="some message"></x-alert>
    <x-alert type="alert" message="some message"></x-alert>

@endsection


