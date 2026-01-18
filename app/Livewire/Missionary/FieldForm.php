<?php

namespace App\Livewire\Missionary;

use App\Enums\ActivityType;
use App\UseCases\Missionary\CreateFieldUseCase;
use App\UseCases\Missionary\UpdateFieldUseCase;
use App\Models\MissionaryField;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class FieldForm extends Component
{
    use WithFileUploads;

    public ?MissionaryField $field = null;
    public $name;
    public $phone;
    public $location_data = [];
    public $description;
    public $structure;
    public $office_hours;
    public $activity_types = [];
    public $is_active = true;
    public $images = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'structure' => 'nullable|string',
            'office_hours' => 'nullable|string|max:255',
            'activity_types' => 'nullable|array',
            'is_active' => 'boolean',
        ];
    }

    public function mount(?MissionaryField $field = null)
    {
        if ($field) {
            $this->field = $field;
            $this->name = $field->name;
            $this->phone = $field->phone;
            $this->description = $field->description;
            $this->structure = $field->structure;
            $this->office_hours = $field->office_hours;
            $this->activity_types = $field->activity_types ?? [];
            $this->is_active = $field->is_active;
        }
    }

    public function save(CreateFieldUseCase $createUseCase, UpdateFieldUseCase $updateUseCase)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'description' => $this->description,
            'structure' => $this->structure,
            'office_hours' => $this->office_hours,
            'activity_types' => $this->activity_types,
            'is_active' => $this->is_active,
        ];

        if ($this->field) {
            $updateUseCase->execute($this->field, $data);
            session()->flash('message', 'Campo atualizado com sucesso!');
        } else {
            $createUseCase->execute(auth()->user(), $data);
            session()->flash('message', 'Campo criado com sucesso!');
        }

        return redirect()->route('missionary.dashboard');
    }

    public function getActivityTypesProperty()
    {
        return ActivityType::cases();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.missionary.field-form');
    }
}
