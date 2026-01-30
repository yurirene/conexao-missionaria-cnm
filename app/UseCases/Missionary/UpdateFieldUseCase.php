<?php

namespace App\UseCases\Missionary;

use App\Models\MissionaryField;
use Illuminate\Support\Facades\DB;

class UpdateFieldUseCase
{
    public function execute(MissionaryField $field, array $data): MissionaryField
    {
        return DB::transaction(function () use ($field, $data) {
            // Atribuir diretamente ao modelo para que os casts funcionem corretamente
            if (isset($data['name'])) {
                $field->name = $data['name'];
            }
            if (isset($data['phone'])) {
                $field->phone = $data['phone'];
            }
            if (isset($data['location_data'])) {
                $field->location_data = $data['location_data'];
            }
            if (isset($data['description'])) {
                $field->description = $data['description'];
            }
            if (isset($data['structure'])) {
                $field->structure = $data['structure'];
            }
            if (isset($data['office_hours'])) {
                $field->office_hours = $data['office_hours'];
            }
            if (isset($data['activity_types'])) {
                // Atribuir array diretamente - o cast 'array' do modelo fará a conversão para JSON
                $field->activity_types = $data['activity_types'];
            }
            if (isset($data['is_active'])) {
                $field->is_active = $data['is_active'];
            }

            $field->save();

            return $field->fresh();
        });
    }
}
