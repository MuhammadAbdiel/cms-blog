<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>

        @if (Request::is('login') || Request::is('register'))
        Blog
        @else
        {{ $title }}
        @endif

    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="app">

        @if (Request::is('/') || Request::is('posts') || Request::is('categories') || Request::is('authors') ||
        Request::is('login') ||
        Request::is('register'))
        @include('layouts.navbar')
        @endif

        @yield('single-post')

        <main class="py-4">
            <div class="container">

                @yield('content')

            </div>
        </main>

        @if (Request::is('/') || Request::is('posts') || Request::is('categories') || Request::is('authors'))
        <footer class="sticky-bottom">
            <hr>
            <div class="container text-center">
                <p class="text-muted">Copyright &copy; 2022 | All right reserved.</p>
            </div>
        </footer>
        @endif

    </div>

    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
</body>

</html>