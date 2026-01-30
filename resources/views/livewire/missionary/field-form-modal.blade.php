<div>
    @if($show)
        <!-- Modal -->
        <div class="modal fade show d-block" id="fieldFormModal" tabindex="-1"
             aria-labelledby="fieldFormModalLabel" aria-modal="true" role="dialog"
             style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fieldFormModalLabel">Cadastrar Campo Missionário</h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nome do Campo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Telefone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" wire:model="phone" placeholder="(00) 00000-0000">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Localização</label>
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <input type="text" class="form-control @error('location_zip') is-invalid @enderror"
                                            id="location_zip" wire:model="location_zip" placeholder="CEP">
                                        @error('location_zip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <input type="text" class="form-control @error('location_address') is-invalid @enderror"
                                            id="location_address" wire:model="location_address" placeholder="Endereço">
                                        @error('location_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="text" class="form-control @error('location_city') is-invalid @enderror"
                                            id="location_city" wire:model="location_city" placeholder="Cidade">
                                        @error('location_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <input type="text" class="form-control @error('location_state') is-invalid @enderror"
                                            id="location_state" wire:model="location_state" placeholder="UF" maxlength="2">
                                        @error('location_state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" wire:model="description" rows="3"
                                      placeholder="Descreva o campo missionário..."></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estrutura do Local</label>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="structure_rooms" class="form-label small">Quantidade de Salas</label>
                                    <input type="number" class="form-control @error('structure_rooms') is-invalid @enderror"
                                           id="structure_rooms" wire:model="structure_rooms" min="0" placeholder="Ex: 5">
                                    @error('structure_rooms') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="structure_temple_capacity" class="form-label small">Capacidade do Templo</label>
                                    <input type="number" class="form-control @error('structure_temple_capacity') is-invalid @enderror"
                                           id="structure_temple_capacity" wire:model="structure_temple_capacity" min="0" placeholder="Ex: 200">
                                    @error('structure_temple_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="structure_bathrooms" class="form-label small">Quantidade de Banheiros</label>
                                    <input type="number" class="form-control @error('structure_bathrooms') is-invalid @enderror"
                                           id="structure_bathrooms" wire:model="structure_bathrooms" min="0" placeholder="Ex: 3">
                                    @error('structure_bathrooms') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="structure_kitchens" class="form-label small">Quantidade de Cozinhas</label>
                                    <input type="number" class="form-control @error('structure_kitchens') is-invalid @enderror"
                                           id="structure_kitchens" wire:model="structure_kitchens" min="0" placeholder="Ex: 1">
                                    @error('structure_kitchens') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="structure_accommodation_capacity" class="form-label small">Capacidade de Alojamento</label>
                                    <input type="number" class="form-control @error('structure_accommodation_capacity') is-invalid @enderror"
                                           id="structure_accommodation_capacity" wire:model="structure_accommodation_capacity" min="0" placeholder="Ex: 30">
                                    @error('structure_accommodation_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="structure_has_external_area"
                                               wire:model="structure_has_external_area">
                                        <label class="form-check-label" for="structure_has_external_area">
                                            Possui área externa
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="office_hours" class="form-label">Horário de Atendimento</label>
                            <input type="text" class="form-control @error('office_hours') is-invalid @enderror"
                                   id="office_hours" wire:model="office_hours"
                                   placeholder="Ex: Segunda a Sexta, 8h às 17h">
                            @error('office_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Imagens do Campo</label>
                            <input type="file" class="form-control @error('images.*') is-invalid @enderror"
                                   id="images" wire:model="images" multiple accept="image/*">
                            @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted">Formatos: JPEG, PNG, JPG, WEBP. Máx: 5MB por imagem.</small>

                            @if(!empty($images))
                                <div class="mt-2">
                                    <div class="row">
                                        @foreach($images as $index => $image)
                                            <div class="col-md-4 mb-2">
                                                <div class="position-relative">
                                                    <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="width: 100%; height: 100px; object-fit: cover;">
                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                            wire:click="removeImage({{ $index }})">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipos de Atividades Desejadas</label>
                            <div class="row">
                                @foreach($this->activityTypes as $activityType)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   id="activity_{{ $activityType->value }}"
                                                   wire:click="toggleActivity('{{ $activityType->value }}')"
                                                   @if(in_array($activityType->value, $activity_types)) checked @endif>
                                            <label class="form-check-label" for="activity_{{ $activityType->value }}">
                                                {{ $activityType->label() }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active"
                                       wire:model="is_active">
                                <label class="form-check-label" for="is_active">
                                    Campo ativo e disponível para conexões
                                </label>
                            </div>
                        </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="close">Cancelar</button>
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove>Salvar Campo</span>
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
