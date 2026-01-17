<div>
    <h1>Dashboard Missionário</h1>
    
    @if($field)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $field->name }}</h5>
                <p class="card-text">{{ $field->description }}</p>
                <a href="{{ route('missionary.field.edit', $field) }}" class="btn btn-primary">Editar Campo</a>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <p>Você ainda não cadastrou um campo missionário.</p>
            <a href="{{ route('missionary.field.create') }}" class="btn btn-primary">Cadastrar Campo</a>
        </div>
    @endif
</div>
