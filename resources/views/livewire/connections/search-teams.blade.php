<div>
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <div class="col">
            <h3 class="">
                <i class="bi bi-search"></i>
                Buscar Equipes de Voluntários
            </h3>
            <p class="text-muted">Encontre equipes disponíveis para realizar atividades missionárias</p>
        </div>
        <div class="col d-flex justify-content-end align-items-end">
            <a href="{{ route('missionary.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Barra de Filtros --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="bi bi-funnel"></i>
                Filtros de Busca
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Especialidades (Atividades)</label>
                    <div class="row">
                        @foreach($this->activityTypes as $activity)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           id="filter_activity_{{ $activity->value }}"
                                           wire:click="toggleActivity('{{ $activity->value }}')"
                                           @if(in_array($activity->value, $selectedActivities ?? [])) checked @endif>
                                    <label class="form-check-label" for="filter_activity_{{ $activity->value }}">
                                        {{ $activity->label() }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-outline-secondary" wire:click="clearFilters">
                        <i class="bi bi-x-circle"></i>
                        Limpar Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Listagem de Equipes --}}
    <div class="card">
        <div class="card-body">
            @if($teams->count() > 0)
                <div class="row">
                    @foreach($teams as $team)
                        <div class="col-md-12 mb-3">
                            <div class="card user-card p-3 shadow-sm" style="background-color: #f8f9fa; cursor: pointer; transition: all 0.3s;"
                                 wire:click="openTeamDetailsModal('{{ $team->id }}', '{{ $field->id }}')"
                                 onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                 onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/img/avatar2.avif') }}" alt="Equipe" style="width: 50px; height: 50px; margin-right: 30px; object-fit: cover; border-radius: 50%;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $team->church_name }}</h6>
                                                <small class="text-muted">
                                                    <i class="bi bi-person"></i> {{ $team->responsible_officer }}
                                                    @if($team->responsible_officer_phone)
                                                        - {{ $team->responsible_officer_phone }}
                                                    @endif
                                                </small>
                                                @if($team->available_start && $team->available_end)
                                                    <div class="small mt-1 text-muted">
                                                        <i class="bi bi-calendar"></i>
                                                        {{ $team->available_start->format('d/m/Y') }} até {{ $team->available_end->format('d/m/Y') }}
                                                    </div>
                                                @elseif($team->available_start)
                                                    <div class="small mt-1 text-muted">
                                                        <i class="bi bi-calendar"></i>
                                                        A partir de {{ $team->available_start->format('d/m/Y') }}
                                                    </div>
                                                @else
                                                    <div class="small mt-1 text-muted">
                                                        <small class="text-muted">Período disponível não definido</small>
                                                    </div>
                                                @endif
                                                @if($team->members->count() > 0)
                                                    <div class="small mt-1 text-muted">
                                                        <i class="bi bi-people"></i> {{ $team->members->count() }} membro(s)
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-2 gap-2">
                                            @if($team->activities && count($team->activities) > 0)
                                                @foreach($team->activities as $activity)
                                                    <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-light-secondary">Nenhuma atividade cadastrada</span>
                                            @endif
                                            @php
                                                $connection = $team->connections->where('missionary_field_id', $field->id)->last();
                                            @endphp
                                            @if($connection)
                                            <span class="badge bg-light-success m-1">{{ $connection->status->label() }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginação --}}
                <div class="mt-4">
                    {{ $teams->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <h5>Nenhuma equipe encontrada</h5>
                    <p>Tente ajustar os filtros de busca ou verifique se há equipes disponíveis.</p>
                </div>
            @endif
        </div>
    </div>

    @livewire('connections.team-details-modal')
</div>
