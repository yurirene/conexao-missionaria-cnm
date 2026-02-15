<div class="card card-rounded-tw">
    <div class="card-header">
        <h3>{{ $team ? 'Editar' : 'Cadastrar' }} Informações da Equipe</h3>
    </div>
    <div class="card-body">
        <form wire:submit="save">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="church_name" class="form-label">Nome da Igreja</label>
                    <input type="text" class="form-control @error('church_name') is-invalid @enderror" id="church_name" wire:model="church_name">
                    @error('church_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="responsible_officer" class="form-label">Nome do Oficial Responsável</label>
                    <input type="text" class="form-control @error('responsible_officer') is-invalid @enderror" id="responsible_officer" wire:model="responsible_officer">
                    @error('responsible_officer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="responsible_officer_phone" class="form-label">Telefone do Oficial</label>
                    <input type="text" class="form-control @error('responsible_officer_phone') is-invalid @enderror" id="responsible_officer_phone" wire:model="responsible_officer_phone">
                    @error('responsible_officer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="available_start" class="form-label">Período Disponível - Início</label>
                    <input type="date" class="form-control @error('available_start') is-invalid @enderror" id="available_start" wire:model="available_start">
                    @error('available_start') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Deixe em branco se a equipe estiver sempre disponível</small>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="available_end" class="form-label">Período Disponível - Fim</label>
                    <input type="date" class="form-control @error('available_end') is-invalid @enderror" id="available_end" wire:model="available_end">
                    @error('available_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Deixe em branco se a equipe estiver sempre disponível</small>
                </div>
            </div>

            <div class="mb-3">
                <h5 class="form-label mb-4">Atividades que a equipe realiza</h5>
                <div class="row">
                    @foreach($this->activityTypes as $activity)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="activity_{{ $activity->value }}"
                                    wire:click="toggleActivity('{{ $activity->value }}')"
                                    @if(in_array($activity->value, is_array($activities) ? $activities : [])) checked @endif>
                                <label class="form-check-label" for="activity_{{ $activity->value }}">
                                    {{ $activity->label() }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('activities') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_available" wire:model="is_available">
                <label class="form-check-label" for="is_available">Equipe disponível para novas conexões</label>
                <br>
                <small class="text-muted">Se estiver desmarcado, a equipe não será exibida para novas conexões</small>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i>
                Salvar
            </button>
            <a href="{{ route('volunteer.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </form>
    </div>
</div>
