<?php

namespace App\Livewire\Connections;

use App\Enums\ActivityType;
use App\Models\MissionaryField;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\SearchFieldsUseCase;
use App\UseCases\Volunteer\SendConnectionRequestUseCase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SearchFields extends Component
{
    use WithPagination;

    public $team;
    public $selectedActivities = [];
    public $location = '';

    protected $queryString = [
        'selectedActivities' => ['except' => []],
        'location' => ['except' => ''],
    ];

    public function mount()
    {
        $this->loadTeam();
    }

    public function loadTeam()
    {
        $this->team = auth()->user()->fresh()->volunteerTeam;

        if (!$this->team) {
            return redirect()->route('volunteer.team.create');
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

    public function openFieldDetailsModal(string $fieldId, string $teamId): void
    {
        $this->dispatch('openFieldDetailsModal', $fieldId, $teamId)->to(FieldDetailsModal::class);
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
    public function render(SearchFieldsUseCase $searchUseCase)
    {
        $filters = [
            'activities' => $this->selectedActivities,
            'location' => $this->location,
        ];

        $fields = $searchUseCase->execute(
            $filters,
            $this->team?->id,
            12
        );

        return view('livewire.connections.search-fields', [
            'fields' => $fields,
        ]);
    }
}
