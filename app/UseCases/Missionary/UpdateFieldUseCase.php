<?php

namespace App\UseCases\Missionary;

use App\Models\MissionaryField;
use Illuminate\Support\Facades\DB;

class UpdateFieldUseCase
{
    public function execute(MissionaryField $field, array $data): MissionaryField
    {
        return DB::transaction(function () use ($field, $data) {
            $field->update($data);
            $field->refresh();

            return $field;
        });
    }
}
