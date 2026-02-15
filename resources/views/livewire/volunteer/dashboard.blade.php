<div>
    @if($team)
        <div class="row d-flex justify-content-between align-items-center mb-4">
            <div class="col">
                <h3 class="">
                    <i class="bi bi-church"></i>
                    {{ $team->church_name }}
                </h3>

                <div class="mb-2">
                    <strong>Status:</strong>
                    @if($team->is_available)
                        <span class="badge bg-light-success">Disponível</span>
                    @else
                        <span class="badge bg-light-secondary">Indisponível</span>
                    @endif
                </div>
            </div>
            <div class="col d-flex justify-content-end align-items-end">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle me-2" type="button" id="equipeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear"></i>
                        Ações da Equipe
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="equipeDropdown">
                        <li>
                            <button type="button" class="dropdown-item" wire:click="openAddMemberModal">
                                <i class="bi bi-person-plus me-1"></i> Adicionar Membro
                            </button>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('volunteer.team.edit', $team) }}">
                                <i class="bi bi-pencil me-1"></i> Editar Informações
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card mb-4 card-rounded-tw">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            <strong>Oficial Responsável:</strong> {{ $team->responsible_officer }}
                            @if($team->responsible_officer_phone)
                                - {{ $team->responsible_officer_phone }}
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if($team->available_start && $team->available_end)
                            <strong>Período Disponível:</strong>
                            {{ $team->available_start->format('d/m/Y') }} até {{ $team->available_end?->format('d/m/Y') }}
                        @endif
                    </div>
                </div>
                <div class="mb-2">
                    <strong>Atividades:</strong>
                    <br>
                    @if($team->activities)
                        @foreach($team->activities as $activity)
                            <span class="badge bg-light-primary">{{ \App\Enums\ActivityType::from($activity)->label() }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Nenhuma atividade cadastrada</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card card-rounded-tw">
            <div class="card-body">
                <h5 class="card-title">Membros da Equipe</h5>
                <p class="text-muted">Gerencie os membros da sua equipe aqui.</p>

                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table ">
                        @foreach($team->members as $member)
                        <div class="card user-card p-3 shadow-sm" style="background-color: #f8f9fa;">
                            <div class="d-flex align-items-center">
                                <img src="/assets/img/avatar2.avif" class="avatar me-3" alt="foto" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $member->name }}</h6>
                                            <small class="text-muted">{{ $member->role }}</small>
                                            <div class="small mt-1 text-muted">
                                                <i class="bi bi-telephone"></i> {{ $member->phone }}
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge {{ $member->status->badge() }} me-3">{{ $member->status->label() }}</span>
                                            <button type="button" class="btn btn-link text-primary p-1" wire:click="openEditMemberModal('{{ $member->id }}')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-link text-danger p-1"
                                                data-member-id="{{ $member->id }}"
                                                data-member-name="{{ $member->name }}"
                                                onclick="confirmDeleteMember(this)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-2 d-flex gap-2">
                                        @php
                                            $docKeys = ['pastoral_authorization' => 'Autorização', 'criminal_background' => 'Antecedentes', 'terms' => 'Termos', 'lgpd' => 'LGPD'];
                                        @endphp
                                        @foreach($docKeys as $key => $label)
                                            @php $hasFile = !empty($member->file_paths[$key]); @endphp
                                            <a class="badge bg-light-{{ $hasFile ? 'success' : 'danger' }} text-decoration-none"
                                               href="{{ $hasFile ? route('documents.download', ['memberId' => $member->id, 'documentKey' => $key]) : '#' }}"
                                               @if($hasFile) target="_blank" @endif>
                                                <i class="bi bi-file-earmark-text"></i> {{ $label }}
                                            </a>
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
    @else
        <div class="alert alert-info">
            <h5>Bem-vindo ao Conexão Missionária!</h5>
            <p>Você ainda não cadastrou sua equipe de voluntários.</p>
            <p>Complete seu cadastro para começar a buscar campos missionários e fazer conexões.</p>
            <button type="button" class="btn btn-primary" wire:click="$dispatch('openTeamModal')">Cadastrar Equipe</button>
        </div>
    @endif

    @livewire('volunteer.team-form-modal')
    @livewire('volunteer.add-member-modal')
    @livewire('volunteer.edit-member-modal')

</div>

<script>
    function confirmDeleteMember(button) {
        const btn = button;
        const id = btn.getAttribute('data-member-id');
        const name = btn.getAttribute('data-member-name');
        Swal.fire({
            title: 'Excluir membro?',
            text: 'Tem certeza que deseja excluir ' + name + '? Esta ação não pode ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then(function(r) {
            if (r.isConfirmed && typeof Livewire !== 'undefined') {
                var el = btn.closest('[wire\\:id]');
                if (el) {
                    Livewire.find(el.getAttribute('wire:id')).$call('deleteMember', id);
                }
            }
        });
    }
    // function confirmDeleteTeam(url) {
    //     Swal.fire({
    //         title: 'Tem certeza?',
    //         text: 'Esta ação não pode ser desfeita! A equipe e todos os seus membros serão excluídos permanentemente.',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: '#3085d6',
    //         confirmButtonText: 'Sim, excluir!',
    //         cancelButtonText: 'Cancelar',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Criar formulário dinâmico para enviar DELETE
    //             const form = document.createElement('form');
    //             form.method = 'POST';
    //             form.action = url;

    //             const csrfToken = document.createElement('input');
    //             csrfToken.type = 'hidden';
    //             csrfToken.name = '_token';
    //             csrfToken.value = '{{ csrf_token() }}';
    //             form.appendChild(csrfToken);

    //             const methodField = document.createElement('input');
    //             methodField.type = 'hidden';
    //             methodField.name = '_method';
    //             methodField.value = 'DELETE';
    //             form.appendChild(methodField);

    //             document.body.appendChild(form);
    //             form.submit();
    //         }
    //     });
    // }

    // Exibir mensagens de sucesso/erro do Laravel
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: '{{ session('error') }}',
            timer: 4000
        });
    @endif
</script>
