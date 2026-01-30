<?php

namespace App\Livewire\Missionary;

use App\Enums\ActivityType;
use App\UseCases\Missionary\CreateFieldUseCase;
use App\UseCases\Missionary\UpdateFieldUseCase;
use App\UseCases\Missionary\UploadFieldImagesUseCase;
use App\UseCases\Missionary\DeleteFieldImageUseCase;
use App\Models\MissionaryField;
use App\Models\MissionaryFieldImage;
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

    public function mount(?MissionaryField $field = null)
    {
        if ($field && $field->user_id === auth()->id()) {
            $this->field = $field;
            $this->name = $field->name;
            $this->phone = $field->phone ?? '';
            $this->description = $field->description ?? '';
            $this->office_hours = $field->office_hours ?? '';
            $raw = $field->activity_types ?? [];
            $this->activity_types = is_array($raw) ? $raw : [];
            $this->is_active = $field->is_active;

            // Carregar dados de localização
            $location = $field->location_data ?? [];
            $this->location_address = $location['address'] ?? '';
            $this->location_city = $location['city'] ?? '';
            $this->location_state = $location['state'] ?? '';
            $this->location_zip = $location['zip'] ?? '';

            // Carregar dados de estrutura
            $structure = $field->structure ?? [];
            $this->structure_rooms = $structure['rooms'] ?? '';
            $this->structure_temple_capacity = $structure['temple_capacity'] ?? '';
            $this->structure_bathrooms = $structure['bathrooms'] ?? '';
            $this->structure_kitchens = $structure['kitchens'] ?? '';
            $this->structure_accommodation_capacity = $structure['accommodation_capacity'] ?? '';
            $this->structure_has_external_area = $structure['has_external_area'] ?? false;
        }
    }

    public function save(
        CreateFieldUseCase $createUseCase,
        UpdateFieldUseCase $updateUseCase,
        UploadFieldImagesUseCase $uploadImagesUseCase
    ) {
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
                'has_external_area' => $this->structure_has_external_area,
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

        if ($this->field) {
            $field = $updateUseCase->execute($this->field, $data);
            session()->flash('message', 'Campo atualizado com sucesso!');

            // Se houver imagens pendentes, fazer upload
            if (!empty($this->images)) {
                $uploadImagesUseCase->execute($field, $this->images);
                $this->images = [];
            }
        } else {
            $field = $createUseCase->execute(auth()->user(), $data);
            session()->flash('message', 'Campo criado com sucesso!');

            // Processar upload de imagens se houver
            if (!empty($this->images)) {
                $uploadImagesUseCase->execute($field, $this->images);
                $this->images = [];
            }
        }

        return redirect()->route('missionary.dashboard');
    }

    public function updatedImages($value): void
    {
        // Se já existe um campo, fazer upload imediato das novas imagens
        if ($this->field && !empty($this->images)) {
            $this->uploadImagesImmediately();
        }
    }

    public function uploadImagesImmediately(UploadFieldImagesUseCase $uploadUseCase = null): void
    {
        if (!$this->field || empty($this->images)) {
            return;
        }

        try {
            // Validar imagens
            $this->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            // Fazer upload apenas das novas imagens
            if (!$uploadUseCase) {
                $uploadUseCase = app(UploadFieldImagesUseCase::class);
            }

            $uploadUseCase->execute($this->field, $this->images);

            // Limpar array de imagens temporárias após upload
            $this->images = [];

            // Atualizar campo para mostrar novas imagens
            $this->field = $this->field->fresh();
        } catch (\Exception $e) {
            // Em caso de erro, manter as imagens para o usuário tentar novamente
            session()->flash('message', 'Erro ao fazer upload das imagens: ' . $e->getMessage());
        }
    }

    public function removeImage(int $index): void
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function deleteImage(string $imageId, DeleteFieldImageUseCase $deleteUseCase): void
    {
        $image = $this->getImageForUser($imageId);
        if (!$image) {
            session()->flash('message', 'Imagem não encontrada.');
            return;
        }

        $deleteUseCase->execute($image);
        $this->field = $this->field->fresh();
        session()->flash('message', 'Imagem excluída com sucesso!');
    }

    protected function getImageForUser(string $imageId): ?MissionaryFieldImage
    {
        if (!$this->field) {
            return null;
        }

        return $this->field->images()->find($imageId);
    }

    public function toggleActivity(string $activity): void
    {
        if (!is_array($this->activity_types)) {
            $this->activity_types = [];
        }
        if (in_array($activity, $this->activity_types)) {
            $this->activity_types = array_values(array_diff($this->activity_types, [$activity]));
        } else {
            $this->activity_types[] = $activity;
        }
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
