<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        @if(in_array(Route::currentRouteName(), ['profile.edit', 'profile.update']))
            <!-- Profil : pas de sidebar -->
            <div class="p-6">
                @yield('content')
            </div>
        @else
            <!-- Autres pages : sidebar + contenu -->
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-64 bg-white shadow-md">
                    @if(Auth::user()->role === 'director')
                        @include('partials.sidebar_director')
                    @elseif(Auth::user()->role === 'teacher')
                        @include('partials.sidebar_prof')
                    @elseif(Auth::user()->role === 'student')
                        @include('partials.sidebar_student')
                    @endif
                </div>

                <!-- Main Content -->
                <div class="flex-1 p-6">
                    @yield('content')
                </div>
            </div>
        @endif

        <!-- Footer -->
        @include('partials.footer')
    </div>
</body>
</html>
