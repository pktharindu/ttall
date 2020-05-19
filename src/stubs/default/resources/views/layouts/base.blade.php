<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    @stack('before-styles')

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    @stack('after-styles')

    <!-- Turbolinks -->
    <script src="{{ mix('js/turbolinks.js') }}"></script>
</head>

<body>
    @yield('body')

    @stack('before-scripts')
    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
