<div>
    <h1>Dashboard Missionário</h1>
    
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if($field)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $field->name }}</h5>
                <p class="card-text">
                    @if($field->phone)
                        <strong>Telefone:</strong> {{ $field->phone }}<br>
                    @endif
                    @if($field->description)
                        <strong>Descrição:</strong> {{ $field->description }}<br>
                    @endif
                    @if($field->office_hours)
                        <strong>Horário de Atendimento:</strong> {{ $field->office_hours }}<br>
                    @endif
                </p>
                <div class="mb-2">
                    <strong>Atividades Desejadas:</strong>
                    @if($field->activity_types && count($field->activity_types) > 0)
                        @foreach($field->activity_types as $activity)
                            <span class="badge bg-primary">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Nenhuma atividade cadastrada</span>
                    @endif
                </div>
                <div class="mb-2">
                    <strong>Status:</strong> 
                    @if($field->is_active)
                        <span class="badge bg-success">Ativo</span>
                    @else
                        <span class="badge bg-secondary">Inativo</span>
                    @endif
                </div>
                <a href="{{ route('missionary.field.edit', $field) }}" class="btn btn-primary">Editar Campo</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Temporadas</h5>
                <p class="text-muted">Gerencie as temporadas do seu campo missionário.</p>
                <a href="{{ route('missionary.seasons.index') }}" class="btn btn-outline-primary">Gerenciar Temporadas</a>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <h5>Bem-vindo ao Conexão Missionária!</h5>
            <p>Você ainda não cadastrou um campo missionário.</p>
            <p>Complete seu cadastro para começar a receber conexões de equipes de voluntários.</p>
            <a href="{{ route('missionary.field.create') }}" class="btn btn-primary">Cadastrar Campo</a>
        </div>
    @endif
</div>
