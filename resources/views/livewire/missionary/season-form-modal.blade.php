<div>
    @if($show)
        <!-- Modal -->
        <div class="modal fade show d-block" id="seasonFormModal" tabindex="-1"
             aria-labelledby="seasonFormModalLabel" aria-modal="true" role="dialog"
             style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="seasonFormModalLabel">
                            {{ $seasonId ? 'Editar' : 'Cadastrar' }} Temporada
                        </h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Data Início</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date" wire:model="start_date">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Deixe em branco se não houver data específica</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label">Data Fim</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" wire:model="end_date">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Deixe em branco se não houver data específica</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="vacancies" class="form-label">Vagas</label>
                                <input type="number" class="form-control @error('vacancies') is-invalid @enderror"
                                       id="vacancies" wire:model="vacancies" min="0" placeholder="Ex: 30">
                                @error('vacancies')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Número de vagas disponíveis para esta temporada</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Atividades Desejadas</label>
                                <div class="row">
                                    @foreach($this->activityTypes as $activityType)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="activity_{{ $activityType->value }}"
                                                       wire:click="toggleActivity('{{ $activityType->value }}')"
                                                       @if(in_array($activityType->value, $desired_activities)) checked @endif>
                                                <label class="form-check-label" for="activity_{{ $activityType->value }}">
                                                    {{ $activityType->label() }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('desired_activities') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="close">Cancelar</button>
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove>{{ $seasonId ? 'Atualizar' : 'Salvar' }} Temporada</span>
                                    <span wire:loading>Salvando...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
