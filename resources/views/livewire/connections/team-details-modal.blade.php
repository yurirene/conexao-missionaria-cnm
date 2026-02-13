<div>
    @if($show && $team)
        <!-- Modal -->
        <div class="modal fade show d-block" id="teamDetailsModal" tabindex="-1"
             aria-labelledby="teamDetailsModalLabel" aria-modal="true" role="dialog"
             style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="teamDetailsModalLabel">
                            <i class="bi bi-church"></i>
                            {{ $team->church_name }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1">
                                    <strong>Oficial Responsável:</strong>
                                </p>
                                <p class="text-muted">
                                    {{ $team->responsible_officer }}
                                    @if($team->responsible_officer_phone)
                                        <br><i class="bi bi-telephone"></i> {{ $team->responsible_officer_phone }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if($team->available_start || $team->available_end)
                                    <p class="mb-1">
                                        <strong>Período Disponível:</strong>
                                    </p>
                                    <p class="text-muted">
                                        @if($team->available_start && $team->available_end)
                                            <i class="bi bi-calendar"></i>
                                            {{ $team->available_start->format('d/m/Y') }} até {{ $team->available_end->format('d/m/Y') }}
                                        @elseif($team->available_start)
                                            <i class="bi bi-calendar"></i>
                                            A partir de {{ $team->available_start->format('d/m/Y') }}
                                        @elseif($team->available_end)
                                            <i class="bi bi-calendar"></i>
                                            Até {{ $team->available_end->format('d/m/Y') }}
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Atividades que a equipe realiza:</strong>
                            <div class="mt-2">
                                @if($team->activities && count($team->activities) > 0)
                                    @foreach($team->activities as $activity)
                                        <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Nenhuma atividade cadastrada</span>
                                @endif
                            </div>
                        </div>

                        @if($team->members->count() > 0)
                            <div class="mb-3">
                                <strong>Membros da Equipe ({{ $team->members->count() }}):</strong>
                            </div>
                        @endif

                        <div class="alert alert-info">
                            <small>
                                <i class="bi bi-info-circle"></i>
                                Ao solicitar conexão, a equipe receberá uma notificação e poderá aceitar ou rejeitar sua solicitação.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="close">Fechar</button>
                        @if(!$connection)
                            <button type="button" class="btn btn-primary" wire:click="requestConnection">
                                <i class="bi bi-send"></i>
                                Solicitar Conexão
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
