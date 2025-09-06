<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-sans antialiased">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Star</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
            <livewire:styles />
        @if (class_exists(\Livewire\Flux\FluxServiceProvider::class))
            @fluxAppearance
        @endif
        @stack('styles')
    </head>

    <body ">
        @if (class_exists(\Livewire\Flux\FluxServiceProvider::class))
            @fluxScripts
        @endif

        @stack('modals')
        @stack('scripts')
        @yield('content')

    </body>
</html>
