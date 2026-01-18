<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Conexão Missionária')</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
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

        .azul {
            color: #1e3a5f !important;
        }

        .btn-entrar {
            color: #1e3a5f !important;
            background-color: #fff !important;
            border: 0px;
        }

        .btn-entrar:hover {
            color: #1e3a5f !important;
            background-color: #e6e6e6 !important;
            border: 0px;
        }

        .btn-cadastrar {
            color: #fff !important;
            background-color: #1e3a5f !important;
            border: 1px solid #1e3a5f !important;
            border-radius: 50px;
        }

        .coracoes {
            color: rgb(212 165 116 / 1) !important;
        }

        .texto-hero-section {
            font-size: 3.75rem !important;
            font-weight: 700 !important;
            color: #1e3a5f !important;
            line-height: 1.2;
            margin-bottom: 2rem;
            text-align: left;
        }

        .lead {
            font-size: 1.25rem !important;
            font-weight: 400 !important;
            color: #1e3a5f !important;
            line-height: 1.5;
            margin-bottom: 2rem;
            text-align: left;
        }
        .background-azul {
            background-color: #1e3a5f !important;
        }
        .btn-como-funciona {
            color: #1e3a5f !important;
            background-color: #fff !important;
            border: 0px;
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
                    <li class="nav-item"><a class="btn btn-como-funciona" href="#como-funciona">Como Funciona</a></li>
                    <li class="nav-item"><a class="btn btn-entrar ms-2" href="/login">Entrar</a></li>
                    <li class="nav-item"><a class="btn btn-cadastrar ms-2" href="/register">Cadastrar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="texto-hero-section">Conectando <span class="text-warning coracoes">corações</span> que
                        servem</h1>
                    <p class="lead">Unindo campos missionários e equipes de voluntários para transformar vidas em todo o
                        Brasil.</p>
                    <a href="/cadastro" class="btn btn-primary btn-lg btn-cadastrar">Começar Agora <i
                            class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800"
                        class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </section>

    <section id="como-funciona" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-primary mb-3 azul">Como Funciona</h2>
                <p class="lead text-secondary mx-auto" style="max-width:540px;">
                    Em 4 passos simples, conecte sua equipe a um campo missionário
                </p>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3 d-flex">
                    <div class="bg-white rounded-4 shadow-sm p-4 position-relative flex-fill h-100">
                        <span class="display-4 fw-bold text-primary-50 position-absolute top-0 end-0 pe-3 pt-2" style="opacity:.10;">01</span>
                        <div class="d-flex align-items-center justify-content-center background-azul rounded-3 mb-4" style="width:56px; height:56px;">
                            <i class="bi bi-person-plus text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-primary mb-2 azul">Cadastre-se</h3>
                        <p class="text-secondary mb-0">Crie seu perfil como Campo Missionário ou Equipe de Voluntários</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 d-flex">
                    <div class="bg-white rounded-4 shadow-sm p-4 position-relative flex-fill h-100">
                        <span class="display-4 fw-bold text-primary-50 position-absolute top-0 end-0 pe-3 pt-2" style="opacity:.10;">02</span>
                        <div class="d-flex align-items-center justify-content-center background-azul rounded-3 mb-4" style="width:56px; height:56px;">
                            <i class="bi bi-check-circle text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-primary mb-2 azul">Complete seu Perfil</h3>
                        <p class="text-secondary mb-0">Adicione informações, fotos, documentos e disponibilidades</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 d-flex">
                    <div class="bg-white rounded-4 shadow-sm p-4 position-relative flex-fill h-100">
                        <span class="display-4 fw-bold text-primary-50 position-absolute top-0 end-0 pe-3 pt-2" style="opacity:.10;">03</span>
                        <div class="d-flex align-items-center justify-content-center background-azul rounded-3 mb-4" style="width:56px; height:56px;">
                            <i class="bi bi-globe2 text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-primary mb-2 azul">Busque e Conecte</h3>
                        <p class="text-secondary mb-0">Use filtros para encontrar o campo ou equipe ideal e envie seu pedido</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 d-flex">
                    <div class="bg-white rounded-4 shadow-sm p-4 position-relative flex-fill h-100">
                        <span class="display-4 fw-bold text-primary-50 position-absolute top-0 end-0 pe-3 pt-2" style="opacity:.10;">04</span>
                        <div class="d-flex align-items-center justify-content-center background-azul rounded-3 mb-4" style="width:56px; height:56px;">
                            <i class="bi bi-rocket text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-primary mb-2 azul">Realize a Missão</h3>
                        <p class="text-secondary mb-0">Gerencie a viagem, documentos e orçamento pela plataforma</p>
                    </div>
                </div>
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