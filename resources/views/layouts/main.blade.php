
<!doctype html>
<html lang="en">
<head>
     <meta charset="utf-8">
    <title>@section('title') :: NewsPortal @show</title>

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


</head>
<body>

<x-header></x-header>

<main>



    <div class="album py-3 bg-light">
        @yield('content')
        <head>
            <meta charset="UTF-8">
            <title>Алгоритм</title>
        </head>

        <body>

        </body>
    </div>

</main>

<x-footer></x-footer>


<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


</body>
</html>
