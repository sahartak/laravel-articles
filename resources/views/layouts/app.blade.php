<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- FontAwesome JS-->
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('css/theme-1.css') }}">


</head>
<body>
<header class="header text-center">
    <h1 class="blog-name pt-lg-4 mb-0"><a href="index.html">Laravel Blog</a></h1>

    <nav class="navbar navbar-expand-lg navbar-dark" >

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navigation" class="collapse navbar-collapse flex-column" >


            <ul class="navbar-nav flex-column text-left">
                <li class="nav-item  {{ (request()->is('/')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home fa-fw mr-2"></i>Главная страница <span class="sr-only">
                       </span></a>
                </li>
                <li class="nav-item {{ (request()->is('articles')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('articles')}}"><i class="fas fa-bookmark fa-fw mr-2"></i>Каталог статей</a>
                </li>
            </ul>

        </div>
    </nav>
</header>


@yield('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
