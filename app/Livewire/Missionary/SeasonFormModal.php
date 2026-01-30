<?php

namespace App\Livewire\Missionary;

use App\Enums\ActivityType;
use App\Models\MissionaryField;
use App\Models\Season;
use App\UseCases\Missionary\CreateSeasonUseCase;
use App\UseCases\Missionary\UpdateSeasonUseCase;
use Livewire\Component;
use Livewire\Attributes\On;

class SeasonFormModal extends Component
{
    public bool $show = false;
    public ?string $seasonId = null;

    public $start_date = '';
    public $end_date = '';
    public $vacancies = '';
    public $desired_activities = [];

    protected function rules(): array
    {
        return [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'vacancies' => 'nullable|integer|min:0',
            'desired_activities' => 'nullable|array',
        ];
    }

    public function open(): void
    {
        $this->show = true;
        $this->resetForm();
    }

    public function openEdit(string $seasonId): void
    {
        $season = $this->getSeasonForUser($seasonId);
        if (!$season) {
            session()->flash('message', 'Temporada não encontrada.');
            return;
        }

        $this->seasonId = $seasonId;
        $this->start_date = $season->start_date?->format('Y-m-d') ?? '';
        $this->end_date = $season->end_date?->format('Y-m-d') ?? '';
        $this->vacancies = $season->vacancies ?? '';
        $raw = $season->desired_activities ?? [];
        $this->desired_activities = is_array($raw) ? $raw : [];
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->seasonId = null;
        $this->start_date = '';
        $this->end_date = '';
        $this->vacancies = '';
        $this->desired_activities = [];
        $this->resetValidation();
    }

    public function save(CreateSeasonUseCase $createUseCase, UpdateSeasonUseCase $updateUseCase): void
    {
        $this->validate();

        $field = $this->getField();
        if (!$field) {
            $this->addError('start_date', 'Campo missionário não encontrado.');
            return;
        }

        $data = [
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
            'vacancies' => $this->vacancies !== '' ? (int)$this->vacancies : null,
            'desired_activities' => $this->desired_activities,
        ];

        if ($this->seasonId) {
            $season = $this->getSeasonForUser($this->seasonId);
            if ($season) {
                $updateUseCase->execute($season, $data);
                $this->dispatch('season-updated')->to(SeasonsIndex::class);
                session()->flash('message', 'Temporada atualizada com sucesso!');
            }
        } else {
            $createUseCase->execute($field, $data);
            $this->dispatch('season-created')->to(SeasonsIndex::class);
            session()->flash('message', 'Temporada criada com sucesso!');
        }

        $this->close();
    }

    public function toggleActivity(string $activity): void
    {
        if (!is_array($this->desired_activities)) {
            $this->desired_activities = [];
        }
        if (in_array($activity, $this->desired_activities)) {
            $this->desired_activities = array_values(array_diff($this->desired_activities, [$activity]));
        } else {
            $this->desired_activities[] = $activity;
        }
    }

    protected function getField(): ?MissionaryField
    {
        return auth()->user()->fresh()->missionaryField;
    }

    protected function getSeasonForUser(string $seasonId): ?Season
    {
        $field = $this->getField();
        if (!$field) {
            return null;
        }

        return $field->seasons()->find($seasonId);
    }

    #[On('openAddSeasonModal')]
    public function handleOpenAddModal(): void
    {
        $this->open();
    }

    #[On('openEditSeasonModal')]
    public function handleOpenEditModal(string $seasonId): void
    {
        $this->openEdit($seasonId);
    }

    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    public function render()
    {
        return view('livewire.missionary.season-form-modal');
    }
}
