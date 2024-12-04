<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('pwa.favicon')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- AlpineJS Intersect Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.js"></script>

    <!-- Styles -->
    @livewireStyles

    <!-- PWA Manifest -->
    @include('pwa.manifest')

    @stack('scripts')
</head>
<body>
<div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
{{--    @include('mega-menu')--}}

    @if(isset($slot))
        {{ $slot }}
    @else
        @yield('content');
    @endif

{{--    @include('footer')--}}
</div>

<x-impersonate::banner/>

@livewireScripts

</body>
</html>