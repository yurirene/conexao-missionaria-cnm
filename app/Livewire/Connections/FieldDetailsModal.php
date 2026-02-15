<?php

namespace App\Livewire\Connections;

use App\Enums\ActivityType;
use App\Enums\ConnectionStatus;
use App\Models\MissionaryField;
use App\Models\Season;
use App\UseCases\Volunteer\SendConnectionRequestUseCase;
use Livewire\Component;
use Livewire\Attributes\On;

class FieldDetailsModal extends Component
{
    public bool $show = false;
    public ?string $fieldId = null;
    public ?MissionaryField $field = null;
    public ?string $selectedSeasonId = null;

    public bool $hasConnection = false;

    public function open(string $fieldId, string $teamId): void
    {
        $this->fieldId = $fieldId;
        $this->field = MissionaryField::with('user', 'seasons', 'images')->find($fieldId);

        if ($this->field) {
            $this->hasConnection = $this->field->connections()
                ->where('volunteer_team_id', $teamId)
                ->whereIn('status', [ConnectionStatus::SENT, ConnectionStatus::ACCEPTED])
                ->exists();
        }

        $this->show = true;
        $this->dispatch('fieldDetailsModalShown');
    }

    public function close(): void
    {
        $this->show = false;
        $this->fieldId = null;
        $this->field = null;
        $this->selectedSeasonId = null;
    }

    public function requestConnection(SendConnectionRequestUseCase $sendConnectionUseCase): void
    {
        if (!$this->field) {
            session()->flash('error', 'Campo missionário não encontrado.');
            return;
        }

        $team = auth()->user()->volunteerTeam;
        if (!$team) {
            session()->flash('error', 'Equipe não encontrada.');
            return;
        }

        try {
            $sendConnectionUseCase->execute($team, $this->field, $this->selectedSeasonId);
            $this->close();
            $this->dispatch('connection-requested');
            session()->flash('message', 'Solicitação de conexão enviada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    #[On('openFieldDetailsModal')]
    public function handleOpenModal(string $fieldId, string $teamId): void
    {
        $this->open($fieldId, $teamId);
    }

    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    public function render()
    {
        return view('livewire.connections.field-details-modal');
    }
}
