<?php

namespace App\Livewire\Volunteer;

use App\Enums\ActivityType;
use App\UseCases\Volunteer\CreateTeamUseCase;
use App\UseCases\Volunteer\UpdateTeamUseCase;
use App\Models\VolunteerTeam;
use Livewire\Component;
use Livewire\Attributes\Layout;

class TeamForm extends Component
{
    public ?VolunteerTeam $team = null;
    public $church_name = '';
    public $responsible_officer = '';
    public $responsible_officer_phone = '';
    public $activities = [];
    public $available_start = '';
    public $available_end = '';
    public $is_available = true;

    protected function rules()
    {
        return [
            'church_name' => 'required|string|max:255',
            'responsible_officer' => 'required|string|max:255',
            'responsible_officer_phone' => 'nullable|string|max:20',
            'activities' => 'nullable|array',
            'available_start' => 'nullable|date',
            'available_end' => 'nullable|date|after_or_equal:available_start',
            'is_available' => 'boolean',
        ];
    }

    public function mount(?VolunteerTeam $team = null)
    {
        if ($team && $team->user_id === auth()->id()) {
            $this->team = $team;
            $this->church_name = $team->church_name;
            $this->responsible_officer = $team->responsible_officer;
            $this->responsible_officer_phone = $team->responsible_officer_phone ?? '';
            $raw = $team->activities ?? [];
            $this->activities = is_array($raw) ? $raw : [];
            $this->available_start = $team->available_start?->format('Y-m-d') ?? '';
            $this->available_end = $team->available_end?->format('Y-m-d') ?? '';
            $this->is_available = $team->is_available;
        }
    }

    public function save(CreateTeamUseCase $createUseCase, UpdateTeamUseCase $updateUseCase = null)
    {
        $this->validate();

        $data = [
            'church_name' => $this->church_name,
            'responsible_officer' => $this->responsible_officer,
            'responsible_officer_phone' => $this->responsible_officer_phone,
            'activities' => $this->activities,
            'available_start' => $this->available_start ?: null,
            'available_end' => $this->available_end ?: null,
            'is_available' => $this->is_available,
        ];

        if ($this->team) {
            if (!$updateUseCase) {
                $updateUseCase = app(UpdateTeamUseCase::class);
            }
            $updateUseCase->execute($this->team, $data);
            session()->flash('message', 'Equipe atualizada com sucesso!');
        } else {
            $createUseCase->execute(auth()->user(), $data);
            session()->flash('message', 'Equipe criada com sucesso!');
        }

        return redirect()->route('volunteer.dashboard');
    }

    public function toggleActivity(string $activity): void
    {
        if (!is_array($this->activities)) {
            $this->activities = [];
        }
        if (in_array($activity, $this->activities)) {
            $this->activities = array_values(array_diff($this->activities, [$activity]));
        } else {
            $this->activities[] = $activity;
        }
    }

    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.volunteer.team-form');
    }
}
