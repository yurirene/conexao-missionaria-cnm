<?php

namespace App\UseCases\Missionary;

use App\Models\MissionaryField;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class CreateSeasonUseCase
{
    public function execute(MissionaryField $field, array $data): Season
    {
        return DB::transaction(function () use ($field, $data) {
            $data['missionary_field_id'] = $field->id;

            return Season::create($data);
        });
    }
}
