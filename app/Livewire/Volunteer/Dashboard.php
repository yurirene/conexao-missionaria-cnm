<?php

namespace App\Livewire\Volunteer;

use App\Livewire\Volunteer\AddMemberModal;
use App\Livewire\Volunteer\EditMemberModal;
use App\Models\TeamMember;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\DeleteTeamMemberUseCase;
use App\UseCases\Volunteer\DeleteMemberFilesUseCase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $team;
    protected $listeners = [
        'team-created' => 'loadTeam',
        'member-added' => 'loadTeam',
        'member-updated' => 'loadTeam',
        'member-deleted' => 'loadTeam',
    ];

    public function mount()
    {
        $this->loadTeam();
    }

    public function loadTeam()
    {
        $this->team = auth()->user()->fresh()->volunteerTeam;
    }

    public function openAddMemberModal(): void
    {
        $this->dispatch('openAddMemberModal')->to(AddMemberModal::class);
    }

    public function openEditMemberModal(string $memberId): void
    {
        $this->dispatch('openEditMemberModal', $memberId)->to(EditMemberModal::class);
    }

    public function deleteMember(string $memberId, DeleteTeamMemberUseCase $deleteUseCase, DeleteMemberFilesUseCase $deleteFilesUseCase): void
    {
        $member = $this->getMemberForUser($memberId);
        if (!$member) {
            session()->flash('message', 'Membro não encontrado.');
            return;
        }

        $suscessoAoRemover = $deleteUseCase->execute($member);
        if ($suscessoAoRemover) {
            $deleteFilesUseCase->execute($member);
        }

        $this->dispatch('member-deleted');
        session()->flash('message', 'Membro excluído com sucesso!');
    }

    protected function getMemberForUser(string $memberId): ?TeamMember
    {
        $team = auth()->user()->volunteerTeam;
        if (!$team) {
            return null;
        }

        return $team->members()->find($memberId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.volunteer.dashboard');
    }
}
