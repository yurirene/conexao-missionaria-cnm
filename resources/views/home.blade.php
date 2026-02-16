<x-app-layout>
    <x-slot name="title">Início</x-slot>

    <div class="container-fluid">
        {{-- Título --}}
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 mb-1">
                    <i class="bi bi-house-door-fill text-primary me-2"></i>
                    Início
                </h2>
                <p class="text-muted mb-0">Visão geral do Conexão Missionária</p>
            </div>
        </div>

        {{-- Totalizadores --}}
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card card-rounded-tw border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="flex-shrink-0 rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-geo-alt-fill text-primary fs-2"></i>
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Campos missionários</p>
                            <p class="h4 mb-0 fw-bold">{{ number_format($totalMissionaryFields) }}</p>
                            <small class="text-muted">cadastrados</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card card-rounded-tw border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="flex-shrink-0 rounded-3 bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-people-fill text-success fs-2"></i>
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Times de voluntários</p>
                            <p class="h4 mb-0 fw-bold">{{ number_format($totalVolunteerTeams) }}</p>
                            <small class="text-muted">cadastrados</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card card-rounded-tw border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="flex-shrink-0 rounded-3 bg-info bg-opacity-10 p-3 me-3">
                            <i class="bi bi-link-45deg text-info fs-2"></i>
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Conexões realizadas</p>
                            <p class="h4 mb-0 fw-bold">{{ number_format($totalConnectionsRealized) }}</p>
                            <small class="text-muted">concluídas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sobre o projeto + PDF --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-rounded-tw border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>
                            Sobre o projeto
                        </h5>
                        <p class="text-body mb-4">{{ config('conexao.project.description') }}</p>
                        <a href="{{ config('conexao.project.pdf_url') }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary">
                            <i class="bi bi-file-pdf me-2"></i>
                            Ver PDF do projeto
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cards de links: APMT e Voluntários --}}
        <div class="row g-3 g-md-4">
            <div class="col-12 col-lg-6">
                <div class="card card-rounded-tw border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-briefcase-fill text-primary me-2"></i>
                            Projetos APMT
                        </h5>
                        <p class="text-muted small mt-1 mb-0">Links relacionados aos projetos da APMT</p>
                    </div>
                    <div class="card-body px-4 pb-4 pt-2">
                        <ul class="list-group list-group-flush">
                            @foreach(config('conexao.apmt_links', []) as $link)
                                <li class="list-group-item border-0 px-0 py-2">
                                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none d-flex align-items-center py-2 rounded-2 px-3">
                                        <i class="bi {{ $link['icon'] ?? 'bi-link-45deg' }} text-primary me-3 fs-5"></i>
                                        <span class="text-body">{{ $link['label'] }}</span>
                                        <i class="bi bi-box-arrow-up-right ms-auto text-muted small"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card card-rounded-tw border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person-badge-fill text-success me-2"></i>
                            Formulários e arquivos
                        </h5>
                        <p class="text-muted small mt-1 mb-0">Obrigatórios aos voluntários</p>
                    </div>
                    <div class="card-body px-4 pb-4 pt-2">
                        <ul class="list-group list-group-flush">
                            @foreach(config('conexao.volunteer_links', []) as $link)
                                <li class="list-group-item border-0 px-0 py-2">
                                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none d-flex align-items-center py-2 rounded-2 px-3">
                                        <i class="bi {{ $link['icon'] ?? 'bi-file-earmark' }} text-success me-3 fs-5"></i>
                                        <span class="text-body">{{ $link['label'] }}</span>
                                        <i class="bi bi-box-arrow-up-right ms-auto text-muted small"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
