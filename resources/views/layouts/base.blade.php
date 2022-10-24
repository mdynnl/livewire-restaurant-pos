<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        content="width=device-width, initial-scale=1"
        name="viewport"
    >
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link
        href="{{ url(asset('favicon.ico')) }}"
        rel="shortcut icon"
    >

    <!-- Fonts -->
    {{-- <link
        href="https://rsms.me/inter/inter.css"
        rel="stylesheet"
    > --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

    <!-- CSRF Token -->
    <meta
        content="{{ csrf_token() }}"
        name="csrf-token"
    >
</head>

<body class="flex flex-col h-screen overflow-hidden bg-gray-100 border-4 border-red-900 select-none">

    @yield('body')
    @livewireScripts
    <script
        src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false"
        data-turbo-eval="false"
    ></script>

</body>

</html>
