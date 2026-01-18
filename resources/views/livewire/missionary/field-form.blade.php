<div>
    <h1>{{ $field ? 'Editar' : 'Cadastrar' }} Campo Missionário</h1>

    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form wire:submit="save">
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Campo <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" wire:model="phone" placeholder="(00) 00000-0000">
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description" rows="4" placeholder="Descreva o campo missionário..."></textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="structure" class="form-label">Estrutura do Local</label>
            <textarea class="form-control @error('structure') is-invalid @enderror" id="structure" wire:model="structure" rows="3" placeholder="Descreva a estrutura física do local..."></textarea>
            @error('structure') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="office_hours" class="form-label">Horário de Atendimento</label>
            <input type="text" class="form-control @error('office_hours') is-invalid @enderror" id="office_hours" wire:model="office_hours" placeholder="Ex: Segunda a Sexta, 8h às 17h">
            @error('office_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tipos de Atividades Desejadas</label>
            <div class="row">
                @foreach($this->activityTypes as $activity)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $activity->value }}" 
                                   id="activity_{{ $activity->value }}" 
                                   wire:model="activity_types">
                            <label class="form-check-label" for="activity_{{ $activity->value }}">
                                {{ $activity->label() }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('activity_types') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" wire:model="is_active">
            <label class="form-check-label" for="is_active">Campo ativo e disponível para conexões</label>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                {{ $field ? 'Atualizar' : 'Cadastrar' }} Campo
            </button>
            @if($field)
                <a href="{{ route('missionary.dashboard') }}" class="btn btn-secondary">Cancelar</a>
            @endif
        </div>
    </form>
</div>
