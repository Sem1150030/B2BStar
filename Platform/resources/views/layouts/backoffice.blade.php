<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-sans antialiased">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Star</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Material Icons CDN for sidebar icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <livewire:styles />
        <style>[x-cloak]{display:none !important;}</style>
        @if (class_exists(\Livewire\Flux\FluxServiceProvider::class))
            @fluxAppearance
        @endif
        @stack('styles')
    </head>

    <body class=" bg-gray-50 min-h-screen">
        {{-- Top navigation fixed --}}
        @livewire('backoffice.navigation.sidebar')
            <livewire:alerts.toast />
        @if (class_exists(\Livewire\Flux\FluxServiceProvider::class))
            @fluxScripts
        @endif

        @stack('modals')
        @stack('scripts')
        @yield('content')

        @livewireScripts
    </body>
</html>
