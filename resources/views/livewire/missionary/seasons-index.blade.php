<div>
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <div class="col">
            <h3 class="">
                <i class="bi bi-calendar"></i>
                Gerenciar Temporadas
            </h3>
            <p class="text-muted">Gerencie as temporadas do campo missionário: {{ $field->name }}</p>
        </div>
        <div class="col d-flex justify-content-end align-items-end">
            <button type="button" class="btn btn-primary" wire:click="openAddSeasonModal">
                <i class="bi bi-plus-circle"></i>
                Nova Temporada
            </button>
            <a href="{{ route('missionary.dashboard') }}" class="btn btn-secondary ms-2">
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

    <div class="card">
        <div class="card-body">
            @if(count($seasons) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data Início</th>
                                <th>Data Fim</th>
                                <th>Vagas</th>
                                <th>Atividades Desejadas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seasons as $season)
                                <tr>
                                    <td>
                                        @if($season->start_date)
                                            {{ $season->start_date->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">Não definida</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($season->end_date)
                                            {{ $season->end_date->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">Não definida</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($season->vacancies)
                                            {{ $season->vacancies }}
                                        @else
                                            <span class="text-muted">Não definida</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($season->desired_activities && count($season->desired_activities) > 0)
                                            @foreach($season->desired_activities as $activity)
                                                <span class="badge bg-light-primary">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Nenhuma</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-link text-primary p-1"
                                                wire:click="openEditSeasonModal('{{ $season->id }}')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-link text-danger p-1"
                                                data-season-id="{{ $season->id }}"
                                                onclick="confirmDeleteSeason(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <h5>Nenhuma temporada cadastrada</h5>
                    <p>Comece criando uma nova temporada para o seu campo missionário.</p>
                </div>
            @endif
        </div>
    </div>

    @livewire('missionary.season-form-modal')
</div>

<script>
    function confirmDeleteSeason(button) {
        const btn = button;
        const id = btn.getAttribute('data-season-id');
        Swal.fire({
            title: 'Excluir temporada?',
            text: 'Tem certeza que deseja excluir esta temporada? Esta ação não pode ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then(function(r) {
            if (r.isConfirmed && typeof Livewire !== 'undefined') {
                var el = btn.closest('[wire\\:id]');
                if (el) {
                    Livewire.find(el.getAttribute('wire:id')).$call('deleteSeason', id);
                }
            }
        });
    }
</script>
