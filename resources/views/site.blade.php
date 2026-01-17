<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Conexão Missionária')</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 90px;
        }
        .navnav {
            justify-content: space-between;
            align-items: center;
            display: flex;
            height: 5rem;
            background-color: #fff;
        }

        .hero-section {
            padding: 120px 0;
            background-image: linear-gradient(to bottom right, #fcf9f4);
        }

        .stats-section {
            background: #1e3a5f;
            padding: 60px 0;
        }
        .bg-footer {
            background: #1e3a5f;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e3a5f !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navnav">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">Conexão Missionária</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#como-funciona">Como Funciona</a></li>
                    <li class="nav-item"><a class="btn btn-outline-primary ms-2" href="/login">Entrar</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="/cadastro">Cadastrar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>Conectando <span class="text-warning">corações</span> que servem</h1>
                    <p class="lead">Una campos missionários a equipes de voluntários em todo o Brasil.</p>
                    <a href="/cadastro" class="btn btn-primary btn-lg">Começar Agora</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800"
                        class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </section>


    <section class="stats-section text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col">150+<br><small>Campos</small></div>
                <div class="col">300+<br><small>Equipes</small></div>
                <div class="col">2.500+<br><small>Voluntários</small></div>
                <div class="col">500+<br><small>Missões</small></div>
            </div>
        </div>
    </section>

    <footer class="bg-footer text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <strong>Conexão Missionária</strong>
                    <p class="small">Conectando corações que servem</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>© {{ date('Y') }} Conexão Missionária</small>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>