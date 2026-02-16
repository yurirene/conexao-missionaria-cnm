<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão Missionária - @yield('title', 'Login')</title>
    </title>
    <link rel="shortcut icon" href="/assets/svg/logo_conexao.svg" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/app-dark.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-icons.min.css">
    @stack('styles')
    @livewireStyles
</head>

<body>
    <script src="/assets/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('home') }}"><img src="/assets/svg/logo_conexao_lateral.svg" alt="Logo" class="w-100" style="height: 200px;"></a>
                    </div>
                    {{ $slot }}
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    @stack('scripts')
    @livewireScripts
    <script src="/assets/js/perfect-scrollbar.min.js"></script>
</body>

</html>