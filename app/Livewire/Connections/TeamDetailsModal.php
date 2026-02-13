<?php

namespace App\Livewire\Connections;

use App\Enums\ActivityType;
use App\Enums\ConnectionStatus;
use App\Models\VolunteerTeam;
use App\UseCases\Missionary\SendConnectionRequestUseCase;
use Livewire\Component;
use Livewire\Attributes\On;

class TeamDetailsModal extends Component
{
    public bool $show = false;
    public ?string $teamId = null;
    public ?VolunteerTeam $team = null;

    public bool $connection = false;

    public function open(string $teamId, string $fieldId): void
    {
        $this->teamId = $teamId;
        $this->team = VolunteerTeam::with('user', 'members', 'connections')->find($teamId);

        if ($this->team) {
            $this->connection = $this->team->connections()
                ->where('missionary_field_id', $fieldId)
                ->whereIn('status', [ConnectionStatus::SENT, ConnectionStatus::ACCEPTED])
                ->exists();
        }

        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
        $this->teamId = null;
        $this->team = null;
    }

    public function requestConnection(SendConnectionRequestUseCase $sendConnectionUseCase): void
    {
        if (!$this->team) {
            session()->flash('error', 'Equipe não encontrada.');
            return;
        }

        $field = auth()->user()->missionaryField;
        if (!$field) {
            session()->flash('error', 'Campo missionário não encontrado.');
            return;
        }

        try {
            $sendConnectionUseCase->execute($field, $this->team);
            $this->close();
            $this->dispatch('connection-requested');
            session()->flash('message', 'Solicitação de conexão enviada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    #[On('openTeamDetailsModal')]
    public function handleOpenModal(string $teamId, string $fieldId): void
    {
        $this->open($teamId, $fieldId);
    }

    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    public function render()
    {
        return view('livewire.connections.team-details-modal');
    }
}
