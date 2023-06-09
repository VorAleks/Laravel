<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@section('title') :: AdminNewsPortal @show</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

<x-admin.header></x-admin.header>

<div class="container-fluid">
    <div class="row">
    <x-admin.sidebar></x-admin.sidebar>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('content')



        </main>
    </div>
</div>


<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>
</html>
