<div>
    @if($field)
        <div class="row d-flex justify-content-between align-items-center mb-4">
            <div class="col">
                <h3 class="">
                    <i class="bi bi-geo-alt"></i>
                    {{ $field->name }}
                </h3>

                <div class="mb-2">
                    <strong>Status:</strong>
                    @if($field->is_active)
                        <span class="badge bg-light-success">Ativo</span>
                    @else
                        <span class="badge bg-light-secondary">Inativo</span>
                    @endif
                </div>
            </div>
            <div class="col d-flex justify-content-end align-items-end">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle me-2" type="button" id="fieldDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear"></i>
                        Ações do Campo
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="fieldDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('missionary.field.edit', $field) }}">
                                <i class="bi bi-pencil me-1"></i> Editar Informações
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('missionary.seasons.index') }}">
                                <i class="bi bi-calendar me-1"></i> Gerenciar Temporadas
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="card mb-4 col-md-5" style="height: 600px; overflow: hidden;">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-geo-alt"></i>
                        Meu Campo
                    </h5>
                </div>
                <div class="card-body" style="height: 530px; overflow-y: auto;">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme">
                            @foreach($field->images as $image)
                                <div class="item card-image">
                                     <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $field->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if($field->phone)
                                <p class="card-text">
                                    <strong>Telefone:</strong> {{ $field->phone }}
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($field->office_hours)
                                <p class="card-text">
                                    <strong>Horário de Atendimento:</strong> {{ $field->office_hours }}
                                </p>
                            @endif
                        </div>
                    </div>
                    @if($field->location_data)
                        <p class="card-text">
                            <strong>Localização:</strong>
                            @if($field->location_data['address'])
                                {{ $field->location_data['address'] }},
                            @endif
                            @if($field->location_data['city'])
                                {{ $field->location_data['city'] }}
                            @endif
                            @if($field->location_data['state'])
                                - {{ $field->location_data['state'] }}
                            @endif
                            @if($field->location_data['zip'])
                                ({{ $field->location_data['zip'] }})
                            @endif
                        </p>
                    @endif
                    @if($field->description)
                        <div class="mb-2">
                            <strong>Descrição:</strong>
                            <p class="text-muted">{{ $field->description }}</p>
                        </div>
                    @endif
                    @if($field->structure && is_array($field->structure))
                        <div class="mb-2">
                            <strong>Estrutura do Local:</strong>
                            <table class="table table-sm table-bordered mt-2 mb-0">
                                <tbody>
                                    @if(isset($field->structure['rooms']))
                                        <tr>
                                            <td><small class="text-muted">Salas:</small></td>
                                            <td><strong>{{ $field->structure['rooms'] }}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($field->structure['temple_capacity']))
                                        <tr>
                                            <td><small class="text-muted">Capacidade do Templo:</small></td>
                                            <td><strong>{{ $field->structure['temple_capacity'] }} vagas</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($field->structure['bathrooms']))
                                        <tr>
                                            <td><small class="text-muted">Banheiros:</small></td>
                                            <td><strong>{{ $field->structure['bathrooms'] }}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($field->structure['kitchens']))
                                        <tr>
                                            <td><small class="text-muted">Cozinhas:</small></td>
                                            <td><strong>{{ $field->structure['kitchens'] }}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($field->structure['accommodation_capacity']))
                                        <tr>
                                            <td><small class="text-muted">Capacidade de Alojamento:</small></td>
                                            <td><strong>{{ $field->structure['accommodation_capacity'] }} pessoas</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($field->structure['has_external_area']) && $field->structure['has_external_area'])
                                        <tr>
                                            <td colspan="2">
                                                <span class="badge bg-light-success">
                                                    <i class="bi bi-check-circle"></i> Possui área externa
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="mb-2">
                        <strong>Atividades Desejadas:</strong>
                        <br>
                        @if($field->activity_types && count($field->activity_types) > 0)
                            @foreach($field->activity_types as $activity)
                                <span class="badge bg-light-primary">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">Nenhuma atividade cadastrada</span>
                        @endif
                    </div>
                </div>
            </div>


            <div class="card mb-4 col-md-5 ms-md-5" style="height: 600px; overflow: hidden;">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-calendar"></i>
                        Temporadas
                    </h5>
                </div>
                <div class="card-body" style="height: 530px; overflow-y: auto;">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table class="table ">
                                @foreach($field->seasons as $season)
                                <div class="card user-card p-3 shadow-sm" style="background-color: #f8f9fa;">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/img/calendario.png') }}" alt="Season" style="width: 50px; height: 50px; margin-right: 30px;">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $season->name }}</h6>
                                                    @if ($season->start_date && $season->end_date)
                                                        <small class="text-muted">{{ $season->start_date->format('d/m/Y') }} - {{ $season->end_date->format('d/m/Y') }}</small>
                                                    @else
                                                        <small class="text-muted">Data de início e fim não definida (em aberto)</small>
                                                    @endif
                                                    @if ($season->vacancies)
                                                    <div class="small mt-1 text-muted">
                                                        <i class="bi bi-telephone"></i> {{ $season->vacancies }} vagas
                                                    </div>
                                                    @else
                                                    <div class="small mt-1 text-muted">
                                                        <small class="text-muted">Quantidade de vagas não definida</small>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="mt-2 gap-2">
                                                @foreach($season->desired_activities as $activity)
                                                    <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <h5>Bem-vindo ao Conexão Missionária!</h5>
            <p>Você ainda não cadastrou um campo missionário.</p>
            <p>Complete seu cadastro para começar a receber conexões de equipes de voluntários.</p>
            <button type="button" class="btn btn-primary" wire:click="$dispatch('openFieldModal')">Cadastrar Campo</button>
        </div>
    @endif

    @livewire('missionary.field-form-modal')
</div>
@push('js')
    <script>
        console.log('owl.carousel.min.js');
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items:4,
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                autoplayHoverPause:true,
                autoWidth:true,
                center: true
            })
        });
    </script>
@endpush
