<div>
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <div class="col">
            <h3 class="">
                <i class="bi bi-link-45deg"></i>
                Conexões
            </h3>
            <p class="text-muted">Gerencie suas solicitações de conexão</p>
        </div>
        <div class="col d-flex justify-content-end align-items-end">
            @if(auth()->user()->isMissionary())
                <a href="{{ route('missionary.dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Voltar
                </a>
            @elseif(auth()->user()->isVolunteer())
                <a href="{{ route('volunteer.dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Voltar
                </a>
            @endif
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
                Filtros
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" wire:model.live="filterStatus">
                        <option value="">Todos os status</option>
                        @foreach($this->statusOptions as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo</label>
                    <select class="form-select" wire:model.live="filterType">
                        <option value="">Todas</option>
                        <option value="sent">Enviadas por mim</option>
                        <option value="received">Recebidas</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-secondary w-100" wire:click="clearFilters">
                        <i class="bi bi-x-circle"></i>
                        Limpar Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Listagem de Conexões --}}
    <div class="card card-rounded-tw">
        <div class="card-body">
            @if($connections->count() > 0)
                <div class="row">
                    @foreach($connections as $connection)
                        <div class="col-md-12 mb-3">
                            <div class="card user-card p-3 shadow-sm" style="background-color: #f8f9fa;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-start">
                                            @if(auth()->user()->isMissionary())
                                                {{-- Mostrar informações da equipe --}}
                                                @if($connection->volunteerTeam)
                                                    <img src="{{ asset('assets/img/avatar2.avif') }}" alt="Equipe" style="width: 50px; height: 50px; margin-right: 20px; object-fit: cover; border-radius: 50%;">
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $connection->volunteerTeam->church_name }}</h6>
                                                        <small class="text-muted">
                                                            <i class="bi bi-person"></i> {{ $connection->volunteerTeam->responsible_officer }}
                                                            @if($connection->volunteerTeam->responsible_officer_phone)
                                                                - {{ $connection->volunteerTeam->responsible_officer_phone }}
                                                            @endif
                                                        </small>
                                                        @if($connection->volunteerTeam->activities && count($connection->volunteerTeam->activities) > 0)
                                                            <div class="mt-2">
                                                                @foreach($connection->volunteerTeam->activities as $activity)
                                                                    <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @elseif(auth()->user()->isVolunteer())
                                                {{-- Mostrar informações do campo --}}
                                                @if($connection->missionaryField)
                                                    @if($connection->missionaryField->images->count() > 0)
                                                        <img src="{{ asset('storage/' . $connection->missionaryField->images->first()->image_path) }}" alt="{{ $connection->missionaryField->name }}" style="width: 50px; height: 50px; margin-right: 20px; object-fit: cover; border-radius: 50%;">
                                                    @else
                                                        <img src="{{ asset('assets/img/avatar2.avif') }}" alt="{{ $connection->missionaryField->name }}" style="width: 50px; height: 50px; margin-right: 20px; object-fit: cover; border-radius: 50%;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $connection->missionaryField->name }}</h6>
                                                        @if($connection->missionaryField->phone)
                                                            <small class="text-muted">
                                                                <i class="bi bi-telephone"></i> {{ $connection->missionaryField->phone }}
                                                            </small>
                                                        @endif
                                                        @if($connection->missionaryField->location_data)
                                                            <div class="small mt-1 text-muted">
                                                                <i class="bi bi-geo-alt"></i>
                                                                @if($connection->missionaryField->location_data['city'])
                                                                    {{ $connection->missionaryField->location_data['city'] }}
                                                                @endif
                                                                @if($connection->missionaryField->location_data['state'])
                                                                    - {{ $connection->missionaryField->location_data['state'] }}
                                                                @endif
                                                            </div>
                                                        @endif
                                                        @if($connection->missionaryField->activity_types && count($connection->missionaryField->activity_types) > 0)
                                                            <div class="mt-2">
                                                                @foreach($connection->missionaryField->activity_types as $activity)
                                                                    <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        @if($connection->season)
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar"></i>
                                                    Temporada: {{ $connection->season->start_date ? $connection->season->start_date->format('d/m/Y') : 'Data não definida' }}
                                                    @if($connection->season->end_date)
                                                        até {{ $connection->season->end_date->format('d/m/Y') }}
                                                    @endif
                                                </small>
                                            </div>
                                        @endif
                                        <div class="mt-2">
                                            <span class="badge
                                                @if($connection->status === \App\Enums\ConnectionStatus::SENT) bg-light-info
                                                @elseif($connection->status === \App\Enums\ConnectionStatus::RECEIVED) bg-light-warning
                                                @elseif($connection->status === \App\Enums\ConnectionStatus::ACCEPTED) bg-light-success
                                                @elseif($connection->status === \App\Enums\ConnectionStatus::CONFIRMED) bg-light-primary
                                                @elseif($connection->status === \App\Enums\ConnectionStatus::REJECTED) bg-light-danger
                                                @elseif($connection->status === \App\Enums\ConnectionStatus::CANCELLED) bg-light-warning
                                                @elseif($connection->status === \App\Enums\ConnectionStatus::COMPLETED) bg-light-secondary
                                                @else bg-light-secondary
                                                @endif">
                                                {{ $connection->status->label() }}
                                            </span>
                                            <small class="text-muted ms-2">
                                                @if($connection->initiator_type === 'missionary' && auth()->user()->isMissionary())
                                                    Você enviou
                                                @elseif($connection->initiator_type === 'volunteer' && auth()->user()->isVolunteer())
                                                    Você enviou
                                                @else
                                                    Recebida
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        {{-- Botões de ação baseados no status --}}
                                        @if($connection->status === \App\Enums\ConnectionStatus::SENT || $connection->status === \App\Enums\ConnectionStatus::RECEIVED)
                                            @if($connection->initiator_type !== (auth()->user()->isMissionary() ? 'missionary' : 'volunteer'))
                                                {{-- Recebida - pode aceitar ou rejeitar --}}
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-success btn-sm"
                                                            onclick="confirmAcceptConnection('{{ $connection->id }}')">
                                                        <i class="bi bi-check-circle"></i>
                                                        Aceitar
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmRejectConnection('{{ $connection->id }}')">
                                                        <i class="bi bi-x-circle"></i>
                                                        Recusar
                                                    </button>
                                                </div>
                                            @else
                                                {{-- Enviada - aguardando resposta --}}
                                                <span class="badge bg-light-info">Aguardando resposta</span>
                                            @endif
                                        @elseif($connection->status === \App\Enums\ConnectionStatus::ACCEPTED)
                                            {{-- Aceita - pode confirmar ou cancelar --}}
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary btn-sm"
                                                        onclick="confirmConnectionStatus('{{ $connection->id }}', 'confirm')">
                                                    <i class="bi bi-check2-circle"></i>
                                                    Confirmar
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="confirmConnectionStatus('{{ $connection->id }}', 'cancel')">
                                                    <i class="bi bi-x-octagon"></i>
                                                    Cancelar
                                                </button>
                                            </div>
                                        @elseif($connection->status === \App\Enums\ConnectionStatus::CONFIRMED)
                                            {{-- Confirmada - pode concluir ou cancelar --}}
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-success btn-sm"
                                                        onclick="confirmConnectionStatus('{{ $connection->id }}', 'complete')">
                                                    <i class="bi bi-check-all"></i>
                                                    Marcar como Concluída
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="confirmConnectionStatus('{{ $connection->id }}', 'cancel')">
                                                    <i class="bi bi-x-octagon"></i>
                                                    Cancelar
                                                </button>
                                            </div>
                                        @elseif($connection->status === \App\Enums\ConnectionStatus::COMPLETED)
                                            <span class="badge bg-light-success">Missão Concluída</span>
                                        @elseif($connection->status === \App\Enums\ConnectionStatus::REJECTED)
                                            <span class="badge bg-light-danger">Rejeitada</span>
                                        @elseif($connection->status === \App\Enums\ConnectionStatus::CANCELLED)
                                            <span class="badge bg-light-warning">Cancelada</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginação --}}
                <div class="mt-4">
                    {{ $connections->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <h5>Nenhuma conexão encontrada</h5>
                    <p>
                        @if($filterStatus || $filterType)
                            Tente ajustar os filtros ou
                        @endif
                        @if(auth()->user()->isMissionary())
                            <a href="{{ route('connections.teams.search') }}">busque equipes</a> para iniciar uma conexão.
                        @elseif(auth()->user()->isVolunteer())
                            <a href="{{ route('connections.fields.search') }}">busque campos</a> para iniciar uma conexão.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('js')
<script>
    function confirmAcceptConnection(connectionId) {
        Swal.fire({
            title: 'Aceitar conexão?',
            text: 'Deseja aceitar esta conexão? Isso permitirá que vocês mantenham contato e realizem tratativas.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, aceitar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed && typeof Livewire !== 'undefined') {
                @this.call('acceptConnection', connectionId);
            }
        });
    }

    function confirmRejectConnection(connectionId) {
        Swal.fire({
            title: 'Rejeitar conexão?',
            text: 'Deseja rejeitar esta conexão? Esta ação não pode ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, rejeitar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed && typeof Livewire !== 'undefined') {
                @this.call('rejectConnection', connectionId);
            }
        });
    }

    function confirmConnectionStatus(connectionId, action) {
        let config = {};

        if (action === 'confirm') {
            config = {
                title: 'Confirmar conexão?',
                text: 'Deseja confirmar esta conexão? Isso indica que as tratativas foram concluídas e a missão está agendada.',
                icon: 'question',
                confirmButtonColor: '#007bff',
                confirmButtonText: 'Sim, confirmar'
            };
        } else if (action === 'complete') {
            config = {
                title: 'Marcar como concluída?',
                text: 'Deseja marcar esta conexão como concluída? O campo e a equipe ficarão disponíveis para uma nova missão.',
                icon: 'success',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Sim, concluir'
            };
        } else if (action === 'cancel') {
            config = {
                title: 'Cancelar conexão?',
                text: 'Deseja cancelar esta conexão? O campo e a equipe ficarão disponíveis para novas conexões.',
                icon: 'warning',
                confirmButtonColor: '#ffc107',
                confirmButtonText: 'Sim, cancelar'
            };
        }

        config.showCancelButton = true;
        config.cancelButtonColor = '#6c757d';
        config.cancelButtonText = 'Cancelar';

        Swal.fire(config).then((result) => {
            if (result.isConfirmed && typeof Livewire !== 'undefined') {
                if (action === 'confirm') {
                    @this.call('confirmConnection', connectionId);
                } else if (action === 'complete') {
                    @this.call('completeConnection', connectionId);
                } else if (action === 'cancel') {
                    @this.call('cancelConnection', connectionId);
                }
            }
        });
    }
</script>
@endpush
