<?php

namespace App\Livewire\Missionary;

use App\Enums\ActivityType;
use App\UseCases\Missionary\CreateFieldUseCase;
use App\UseCases\Missionary\UploadFieldImagesUseCase;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class FieldFormModal extends Component
{
    use WithFileUploads;

    public $show = false;
    public $name = '';
    public $phone = '';
    public $location_data = [];
    public $description = '';
    public $structure = '';
    public $office_hours = '';
    public $activity_types = [];
    public $is_active = true;
    public $images = [];

    // Campos de localização
    public $location_address = '';
    public $location_city = '';
    public $location_state = '';
    public $location_zip = '';

    // Campos de estrutura
    public $structure_rooms = '';
    public $structure_temple_capacity = '';
    public $structure_bathrooms = '';
    public $structure_kitchens = '';
    public $structure_accommodation_capacity = '';
    public $structure_has_external_area = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location_address' => 'nullable|string|max:255',
            'location_city' => 'nullable|string|max:255',
            'location_state' => 'nullable|string|max:2',
            'location_zip' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'structure_rooms' => 'nullable|integer|min:0',
            'structure_temple_capacity' => 'nullable|integer|min:0',
            'structure_bathrooms' => 'nullable|integer|min:0',
            'structure_kitchens' => 'nullable|integer|min:0',
            'structure_accommodation_capacity' => 'nullable|integer|min:0',
            'structure_has_external_area' => 'boolean',
            'office_hours' => 'nullable|string|max:255',
            'activity_types' => 'nullable|array',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB
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
        $this->name = '';
        $this->phone = '';
        $this->location_address = '';
        $this->location_city = '';
        $this->location_state = '';
        $this->location_zip = '';
        $this->description = '';
        $this->structure_rooms = '';
        $this->structure_temple_capacity = '';
        $this->structure_bathrooms = '';
        $this->structure_kitchens = '';
        $this->structure_accommodation_capacity = '';
        $this->structure_has_external_area = false;
        $this->office_hours = '';
        $this->activity_types = [];
        $this->is_active = true;
        $this->images = [];
        $this->resetValidation();
    }

    public function save(CreateFieldUseCase $createUseCase, UploadFieldImagesUseCase $uploadImagesUseCase)
    {
        $this->validate();

        // Preparar location_data
        $locationData = [];
        if ($this->location_address || $this->location_city || $this->location_state || $this->location_zip) {
            $locationData = [
                'address' => $this->location_address,
                'city' => $this->location_city,
                'state' => $this->location_state,
                'zip' => $this->location_zip,
            ];
        }

        // Preparar structure_data
        $structureData = [];
        if ($this->structure_rooms !== '' || $this->structure_temple_capacity !== '' ||
            $this->structure_bathrooms !== '' || $this->structure_kitchens !== '' ||
            $this->structure_accommodation_capacity !== '' || $this->structure_has_external_area
        ) {
            $structureData = [
                'rooms' => $this->structure_rooms !== '' ? (int)$this->structure_rooms : null,
                'temple_capacity' => $this->structure_temple_capacity !== '' ? (int)$this->structure_temple_capacity : null,
                'bathrooms' => $this->structure_bathrooms !== '' ? (int)$this->structure_bathrooms : null,
                'kitchens' => $this->structure_kitchens !== '' ? (int)$this->structure_kitchens : null,
                'accommodation_capacity' => $this->structure_accommodation_capacity !== '' ? (int)$this->structure_accommodation_capacity : null,
                'has_external_area' => $this->structure_has_external_area
            ];
        }

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'location_data' => !empty($locationData) ? $locationData : null,
            'description' => $this->description,
            'structure' => !empty($structureData) ? $structureData : null,
            'office_hours' => $this->office_hours,
            'activity_types' => $this->activity_types,
            'is_active' => $this->is_active,
        ];

        $field = $createUseCase->execute(auth()->user(), $data);

        // Processar upload de imagens se houver
        if (!empty($this->images)) {
            $uploadImagesUseCase->execute($field, $this->images);
        }

        $this->close();

        $this->dispatch('field-created')->to(\App\Livewire\Missionary\Dashboard::class);
        session()->flash('message', 'Campo criado com sucesso!');
    }

    public function removeImage(int $index): void
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function toggleActivity($activity)
    {
        if (in_array($activity, $this->activity_types)) {
            $this->activity_types = array_values(array_diff($this->activity_types, [$activity]));
        } else {
            $this->activity_types[] = $activity;
        }
    }

    #[On('openFieldModal')]
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
        return view('livewire.missionary.field-form-modal');
    }
}
