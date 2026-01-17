<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Conexão Missionária') }} - @yield('title', 'Dashboard')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="min-vh-100 d-flex flex-column">
        @auth
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        Conexão Missionária
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>@livewire('auth.logout')</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endauth

        <main class="flex-grow-1">
            <div class="container my-4">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        <footer class="bg-light py-3 mt-auto">
            <div class="container text-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} Conexão Missionária. Todos os direitos reservados.</p>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
