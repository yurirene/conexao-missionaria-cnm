<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Conexão Missionária') }} - @yield('title', 'Login')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2 class="text-primary">Conexão Missionária</h2>
                            </div>
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
