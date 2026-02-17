<div>
    @if($show && $field)
        <!-- Modal -->
        <div class="modal fade show d-block" id="fieldDetailsModal" tabindex="-1"
             aria-labelledby="fieldDetailsModalLabel" aria-modal="true" role="dialog"
             style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fieldDetailsModalLabel">
                            <i class="bi bi-geo-alt"></i>
                            {{ $field->name }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Galeria de Imagens --}}
                        @if($field->images->count() > 0)
                            <div class="mb-4">
                                <div class="owl-carousel owl-theme">
                                    @foreach($field->images as $image)
                                        <div class="item">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 alt="{{ $field->name }}"
                                                 class="img-fluid"
                                                 style="max-height: 300px; object-fit: cover; width: 100%;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                @if($field->phone)
                                    <p class="mb-1">
                                        <strong>Telefone:</strong>
                                    </p>
                                    <p class="text-muted">
                                        <i class="bi bi-telephone"></i> {{ $field->phone }}
                                    </p>
                                @endif
                                @if($field->location_data)
                                    <p class="mb-1">
                                        <strong>Localização:</strong>
                                    </p>
                                    <p class="text-muted">
                                        <i class="bi bi-geo-alt"></i>
                                        @if(!empty($field->location_data['address']))
                                            {{ $field->location_data['address'] }},
                                        @endif
                                        @if(!empty($field->location_data['city']))
                                            {{ $field->location_data['city'] }}
                                        @endif
                                        @if(!empty($field->location_data['state']))
                                            - {{ $field->location_data['state'] }}
                                        @endif
                                        @if(!empty($field->location_data['zip']))
                                            ({{ $field->location_data['zip'] }})
                                        @endif
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($field->office_hours)
                                    <p class="mb-1">
                                        <strong>Horário de Atendimento:</strong>
                                    </p>
                                    <p class="text-muted">{{ $field->office_hours }}</p>
                                @endif
                            </div>
                        </div>

                        @if($field->description)
                            <div class="mb-3">
                                <strong>Descrição:</strong>
                                <p class="text-muted">{{ $field->description }}</p>
                            </div>
                        @endif

                        @if($field->structure && is_array($field->structure))
                            <div class="mb-3">
                                <strong>Estrutura do Local:</strong>
                                <table class="table table-sm table-bordered mt-2">
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

                        <div class="mb-3">
                            <strong>Atividades Desejadas:</strong>
                            <div class="mt-2">
                                @if($field->activity_types && count($field->activity_types) > 0)
                                    @foreach($field->activity_types as $activity)
                                        <span class="badge bg-light-primary m-1">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Nenhuma atividade cadastrada</span>
                                @endif
                            </div>
                        </div>

                        @if($field->seasons->count() > 0)
                            <div class="mb-3">
                                <strong>Temporadas Disponíveis:</strong>
                                <div class="mt-2">
                                    @foreach($field->seasons as $season)
                                        <div class="card mb-2 p-2 card-rounded-tw" style="background-color: #f8f9fa;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="selectedSeason"
                                                       id="season_{{ $season->id }}"
                                                       value="{{ $season->id }}"
                                                       wire:model="selectedSeasonId">
                                                <label class="form-check-label" for="season_{{ $season->id }}">
                                                    <strong>{{ $season->start_date ? $season->start_date->format('d/m/Y') : 'Data não definida' }}</strong>
                                                    @if($season->end_date)
                                                        até {{ $season->end_date->format('d/m/Y') }}
                                                    @endif
                                                    @if($season->vacancies)
                                                        - {{ $season->vacancies }} vagas
                                                    @endif
                                                    @if($season->desired_activities && count($season->desired_activities) > 0)
                                                        <div class="mt-1">
                                                            @foreach($season->desired_activities as $activity)
                                                                <span class="badge bg-light-info">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">Selecione uma temporada específica ou deixe em branco para solicitar conexão geral.</small>
                            </div>
                        @endif

                        @if($hasConnection)
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle"></i>
                                Você já possui uma conexão com este campo.
                            </div>
                        @else
                            <div class="alert alert-info">
                                <small>
                                    <i class="bi bi-info-circle"></i>
                                    Ao solicitar conexão, o campo receberá uma notificação e poderá aceitar ou rejeitar sua solicitação.
                                </small>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="close">Fechar</button>
                        @if(!$hasConnection)
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

@push('js')
    <script>
        $(document).ready(function() {
        });

        Livewire.on('fieldDetailsModalShown', function () {
            setTimeout(function() {
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true
                });
            }, 200);
        });
    </script>
@endpush
