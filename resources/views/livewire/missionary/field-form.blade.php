<div>
    <h1>{{ $field ? 'Editar' : 'Cadastrar' }} Campo Missionário</h1>

    <form wire:submit="save">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" wire:model="phone">
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description" rows="3"></textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="structure" class="form-label">Estrutura</label>
            <textarea class="form-control @error('structure') is-invalid @enderror" id="structure" wire:model="structure" rows="3"></textarea>
            @error('structure') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="office_hours" class="form-label">Horário de Atendimento</label>
            <input type="text" class="form-control @error('office_hours') is-invalid @enderror" id="office_hours" wire:model="office_hours">
            @error('office_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" wire:model="is_active">
            <label class="form-check-label" for="is_active">Ativo</label>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('missionary.dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
