<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('scripts')
</head>

<body>
    <div id="app">
        @include('partials.navbar')

        <main class="py-4 bg-tertiary min-vh-100">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
