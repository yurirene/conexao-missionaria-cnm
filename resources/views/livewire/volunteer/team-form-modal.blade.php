<div>
    @if($show)
        <!-- Modal -->
        <div class="modal fade show d-block" id="teamFormModal" tabindex="-1" 
             aria-labelledby="teamFormModalLabel" aria-modal="true" role="dialog"
             style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="teamFormModalLabel">Cadastrar Equipe de Voluntários</h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label for="church_name" class="form-label">Nome da Igreja <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('church_name') is-invalid @enderror" 
                                   id="church_name" wire:model="church_name" required>
                            @error('church_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="responsible_officer" class="form-label">Oficial Responsável <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('responsible_officer') is-invalid @enderror" 
                                   id="responsible_officer" wire:model="responsible_officer" required>
                            @error('responsible_officer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="responsible_officer_phone" class="form-label">Telefone do Responsável</label>
                            <input type="text" class="form-control @error('responsible_officer_phone') is-invalid @enderror" 
                                   id="responsible_officer_phone" wire:model="responsible_officer_phone" 
                                   placeholder="(00) 00000-0000">
                            @error('responsible_officer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Atividades</label>
                            <div class="row">
                                @foreach($this->activityTypes as $activityType)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   id="activity_{{ $activityType->value }}" 
                                                   wire:click="toggleActivity('{{ $activityType->value }}')"
                                                   @if(in_array($activityType->value, $activities)) checked @endif>
                                            <label class="form-check-label" for="activity_{{ $activityType->value }}">
                                                {{ $activityType->label() }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="available_start" class="form-label">Data Início Disponibilidade</label>
                                <input type="date" class="form-control @error('available_start') is-invalid @enderror" 
                                       id="available_start" wire:model="available_start">
                                @error('available_start')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="available_end" class="form-label">Data Fim Disponibilidade</label>
                                <input type="date" class="form-control @error('available_end') is-invalid @enderror" 
                                       id="available_end" wire:model="available_end">
                                @error('available_end')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_available" 
                                       wire:model="is_available">
                                <label class="form-check-label" for="is_available">
                                    Equipe disponível para conexões
                                </label>
                            </div>
                        </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="close">Cancelar</button>
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove>Salvar Equipe</span>
                                    <span wire:loading>Saving...</span>
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
