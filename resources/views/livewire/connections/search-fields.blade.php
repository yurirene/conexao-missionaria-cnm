<div>
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <div class="col">
            <h3 class="">
                <i class="bi bi-search"></i>
                Buscar Campos Missionários
            </h3>
            <p class="text-muted">Encontre campos missionários que precisam de apoio para atividades</p>
        </div>
        <div class="col d-flex justify-content-end align-items-end">
            <a href="{{ route('volunteer.dashboard') }}" class="btn btn-secondary">
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
    <div class="card mb-4 card-rounded-tw">
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

    {{-- Listagem de Campos --}}
    <div class="card card-rounded-tw">
        <div class="card-body">
            @if($fields->count() > 0)
                <div class="row">
                    @foreach($fields as $field)
                        <div class="col-md-12 mb-3">
                            <div class="card user-card p-3 shadow-sm" style="cursor: pointer; transition: all 0.3s;"
                                 wire:click="openFieldDetailsModal('{{ $field->id }}', '{{ $team->id }}')"
                                 onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                 onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
                                <div class="d-flex align-items-center">
                                    @if($field->images->count() > 0)
                                        <img src="{{ asset('storage/' . $field->images->first()->image_path) }}" alt="{{ $field->name }}" style="width: 50px; height: 50px; margin-right: 30px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('assets/img/avatar2.avif') }}" alt="{{ $field->name }}" style="width: 50px; height: 50px; margin-right: 30px; object-fit: cover; border-radius: 50%;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $field->name }}</h6>
                                                @if($field->phone)
                                                    <small class="text-muted">
                                                        <i class="bi bi-telephone"></i> {{ $field->phone }}
                                                    </small>
                                                @endif
                                                @if($field->location_data)
                                                    <div class="small mt-1 text-muted">
                                                        <i class="bi bi-geo-alt"></i>
                                                        @if($field->location_data['city'])
                                                            {{ $field->location_data['city'] }}
                                                        @endif
                                                        @if($field->location_data['state'])
                                                            - {{ $field->location_data['state'] }}
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($field->seasons->count() > 0)
                                                    <div class="small mt-1 text-muted">
                                                        <i class="bi bi-calendar"></i> {{ $field->seasons->count() }} temporada(s)
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-2 gap-2">
                                            @if($field->activity_types && count($field->activity_types) > 0)
                                                @foreach($field->activity_types as $activity)
                                                    <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-light-secondary">Nenhuma atividade cadastrada</span>
                                            @endif
                                            @php
                                                $connection = $field->connections->where('volunteer_team_id', $team->id)->last();
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
                    {{ $fields->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <h5>Nenhum campo encontrado</h5>
                    <p>Tente ajustar os filtros de busca ou verifique se há campos disponíveis.</p>
                </div>
            @endif
        </div>
    </div>

    @livewire('connections.field-details-modal')
</div>
