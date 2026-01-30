<?php

namespace App\UseCases\Missionary;

use App\Models\Season;
use Illuminate\Support\Facades\DB;

class UpdateSeasonUseCase
{
    public function execute(Season $season, array $data): Season
    {
        return DB::transaction(function () use ($season, $data) {
            // Atribuir diretamente ao modelo para que os casts funcionem corretamente
            if (isset($data['start_date'])) {
                $season->start_date = $data['start_date'] ?: null;
            }
            if (isset($data['end_date'])) {
                $season->end_date = $data['end_date'] ?: null;
            }
            if (isset($data['vacancies'])) {
                $season->vacancies = $data['vacancies'] ?: null;
            }
            if (isset($data['desired_activities'])) {
                // Atribuir array diretamente - o cast 'array' do modelo fará a conversão para JSON
                $season->desired_activities = $data['desired_activities'];
            }

            $season->save();

            return $season->fresh();
        });
    }
}
