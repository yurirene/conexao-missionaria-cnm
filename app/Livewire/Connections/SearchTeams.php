<?php

namespace App\Livewire\Connections;

use App\Enums\ActivityType;
use App\Models\MissionaryField;
use App\Models\VolunteerTeam;
use App\UseCases\Missionary\SearchTeamsUseCase;
use App\UseCases\Missionary\SendConnectionRequestUseCase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SearchTeams extends Component
{
    use WithPagination;

    public $field;
    public $selectedActivities = [];
    public $location = '';

    protected $queryString = [
        'selectedActivities' => ['except' => []],
        'location' => ['except' => ''],
    ];

    public function mount()
    {
        $this->loadField();
    }

    public function loadField()
    {
        $this->field = auth()->user()->fresh()->missionaryField;

        if (!$this->field) {
            return redirect()->route('missionary.field.create');
        }
    }

    public function toggleActivity(string $activity): void
    {
        if (!is_array($this->selectedActivities)) {
            $this->selectedActivities = [];
        }
        if (in_array($activity, $this->selectedActivities)) {
            $this->selectedActivities = array_values(array_diff($this->selectedActivities, [$activity]));
        } else {
            $this->selectedActivities[] = $activity;
        }
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->selectedActivities = [];
        $this->location = '';
        $this->resetPage();
    }

    public function openTeamDetailsModal(string $teamId, string $fieldId): void
    {
        $this->dispatch('openTeamDetailsModal', $teamId, $fieldId)->to(TeamDetailsModal::class);
    }

    #[On('connection-requested')]
    public function handleConnectionRequested(): void
    {
        // Recarregar lista após solicitação de conexão
        $this->resetPage();
    }


    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    #[Layout('layouts.app')]
    public function render(SearchTeamsUseCase $searchUseCase)
    {
        $filters = [
            'activities' => $this->selectedActivities,
            'location' => $this->location,
        ];

        $teams = $searchUseCase->execute(
            $filters,
            $this->field?->id,
            12
        );

        return view('livewire.connections.search-teams', [
            'teams' => $teams,
        ]);
    }
}
