<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>App Landing Page</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @include('pwa.css.landing-page-styles')

    @include('pwa.manifest')
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            <span>Application Landing Page</span>

            <div class="flex justify-center">
                User: {{ Auth::user()?->name }}
            </div>

            <div class="flex justify-center">
                @include('pwa.install-button')
            </div>

            <div class="flex justify-center">
                @include('pwa.notification-buttons')
            </div>

            <div class="flex justify-center">
                @include('pwa.online-status')
            </div>

            <div class="flex justify-center">
                @include('pwa.battery-status')
            </div>

            <div class="flex justify-center">
                @include('pwa.device-type')
            </div>
        </div>
    </div>
</div>
@livewireScripts
</body>
</html>
