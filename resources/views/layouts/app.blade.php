<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('links')

    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">

</head>
<body class="bg-gray-950 flex flex-col min-h-screen">
    <!-- Header -->
    @include('layouts.header')

    @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator']))
        <x-staff.admin-sidebar />
    @endif

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-4 py-8">
        @if (session('info'))
            <div id="notification" data-message="{{ session('info') }}"></div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="{{ asset('js/mobile-menu.js') }}"></script>
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script src="{{ asset('js/panel.js') }}"></script>
    @stack('scripts')
    
</body>
</html>