<?php

namespace App\Livewire\Volunteer;

use App\Enums\ActivityType;
use App\UseCases\Volunteer\CreateTeamUseCase;
use Livewire\Component;
use Livewire\Attributes\On;

class TeamFormModal extends Component
{
    public $show = false;
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

    public function open()
    {
        $this->show = true;
        $this->resetForm();
    }

    public function close()
    {
        $this->show = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->church_name = '';
        $this->responsible_officer = '';
        $this->responsible_officer_phone = '';
        $this->activities = [];
        $this->available_start = '';
        $this->available_end = '';
        $this->is_available = true;
        $this->resetValidation();
    }

    public function save(CreateTeamUseCase $createUseCase)
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

        $createUseCase->execute(auth()->user(), $data);
        
        $this->close();

        $this->dispatch('team-created')->to(\App\Livewire\Volunteer\Dashboard::class);
        session()->flash('message', 'Equipe criada com sucesso!');
    }

    public function toggleActivity($activity)
    {
        if (in_array($activity, $this->activities)) {
            $this->activities = array_values(array_diff($this->activities, [$activity]));
        } else {
            $this->activities[] = $activity;
        }
    }

    #[On('openTeamModal')]
    public function handleOpenModal()
    {
        $this->open();
    }

    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    public function render()
    {
        return view('livewire.volunteer.team-form-modal');
    }
}
