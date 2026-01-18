<div>
    @if($show)
        <div class="modal fade show d-block" id="editMemberModal" tabindex="-1"
             aria-labelledby="editMemberModalLabel" aria-modal="true" role="dialog"
             style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMemberModalLabel">
                            <i class="bi bi-pencil me-2"></i> Editar Membro
                        </h5>
                        <button type="button" class="btn-close" wire:click="close" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_name" class="form-label">Nome <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="edit_member_name" wire:model="name" required
                                           placeholder="Nome completo do membro">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_phone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           id="edit_member_phone" wire:model="phone"
                                           placeholder="(00) 00000-0000">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_church" class="form-label">Igreja</label>
                                    <input type="text" class="form-control @error('church') is-invalid @enderror"
                                           id="edit_member_church" wire:model="church"
                                           placeholder="Nome da igreja do membro">
                                    @error('church')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_role" class="form-label">Função na Equipe</label>
                                    <input type="text" class="form-control @error('role') is-invalid @enderror"
                                           id="edit_member_role" wire:model="role"
                                           placeholder="Ex: Lider, Membro, Secretário, etc.">
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_pastor_name" class="form-label">Nome do Pastor</label>
                                    <input type="text" class="form-control @error('pastor_name') is-invalid @enderror"
                                           id="edit_member_pastor_name" wire:model="pastor_name">
                                    @error('pastor_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_pastor_phone" class="form-label">Telefone do Pastor</label>
                                    <input type="text" class="form-control @error('pastor_phone') is-invalid @enderror"
                                           id="edit_member_pastor_phone" wire:model="pastor_phone"
                                           placeholder="(00) 00000-0000">
                                    @error('pastor_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_member_specialty" class="form-label">Especialidade</label>
                                <input type="text" class="form-control @error('specialty') is-invalid @enderror"
                                       id="edit_member_specialty" wire:model="specialty"
                                       placeholder="Habilidades ou áreas de atuação específicas (ex: Músico, Professor, etc.)">
                                @error('specialty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="edit_member_description" class="form-label">Observações</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="edit_member_description" wire:model="description" rows="3"
                                          placeholder="Informações adicionais sobre o membro"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="form-label mb-2">Documentos</h6>
                            <p class="text-muted small mb-3">PDF ou imagem (JPG, PNG). Máx. 5MB cada. Selecione um novo arquivo para substituir.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_pastoral_authorization" class="form-label">Autorização Pastoral</label>
                                    @if(!empty($existingFilePaths['pastoral_authorization']))
                                        <div class="small text-success mb-1"><i class="bi bi-check-circle"></i> Documento anexado</div>
                                    @endif
                                    <input type="file" class="form-control @error('pastoral_authorization') is-invalid @enderror"
                                           id="edit_member_pastoral_authorization" wire:model="pastoral_authorization"
                                           accept=".pdf,image/jpeg,image/png,image/jpg">
                                    @error('pastoral_authorization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div wire:loading wire:target="pastoral_authorization" class="small text-muted">Enviando...</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_criminal_background" class="form-label">Antecedentes Criminais</label>
                                    @if(!empty($existingFilePaths['criminal_background']))
                                        <div class="small text-success mb-1"><i class="bi bi-check-circle"></i> Documento anexado</div>
                                    @endif
                                    <input type="file" class="form-control @error('criminal_background') is-invalid @enderror"
                                           id="edit_member_criminal_background" wire:model="criminal_background"
                                           accept=".pdf,image/jpeg,image/png,image/jpg">
                                    @error('criminal_background')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div wire:loading wire:target="criminal_background" class="small text-muted">Enviando...</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_terms" class="form-label">Aceite ao Edital do Conexão Missionária (Termos)</label>
                                    @if(!empty($existingFilePaths['terms']))
                                        <div class="small text-success mb-1"><i class="bi bi-check-circle"></i> Documento anexado</div>
                                    @endif
                                    <input type="file" class="form-control @error('terms') is-invalid @enderror"
                                           id="edit_member_terms" wire:model="terms"
                                           accept=".pdf,image/jpeg,image/png,image/jpg">
                                    @error('terms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div wire:loading wire:target="terms" class="small text-muted">Enviando...</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_member_lgpd" class="form-label">Aceite dos termos de tratamento de dados (LGPD)</label>
                                    @if(!empty($existingFilePaths['lgpd']))
                                        <div class="small text-success mb-1"><i class="bi bi-check-circle"></i> Documento anexado</div>
                                    @endif
                                    <input type="file" class="form-control @error('lgpd') is-invalid @enderror"
                                           id="edit_member_lgpd" wire:model="lgpd"
                                           accept=".pdf,image/jpeg,image/png,image/jpg">
                                    @error('lgpd')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div wire:loading wire:target="lgpd" class="small text-muted">Enviando...</div>
                                </div>
                            </div>

                            <div class="modal-footer px-0 pb-0">
                                <button type="button" class="btn btn-secondary" wire:click="close">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove><i class="bi bi-check-lg me-1"></i> Salvar alterações</span>
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
