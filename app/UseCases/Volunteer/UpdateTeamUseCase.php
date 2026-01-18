<?php

namespace App\UseCases\Volunteer;

use App\Models\VolunteerTeam;
use Illuminate\Support\Facades\DB;

class UpdateTeamUseCase
{
    public function execute(VolunteerTeam $team, array $data): VolunteerTeam
    {
        return DB::transaction(function () use ($team, $data) {
            // Atribuir diretamente ao modelo para que os casts funcionem corretamente
            if (isset($data['church_name'])) {
                $team->church_name = $data['church_name'];
            }
            if (isset($data['responsible_officer'])) {
                $team->responsible_officer = $data['responsible_officer'];
            }
            if (isset($data['responsible_officer_phone'])) {
                $team->responsible_officer_phone = $data['responsible_officer_phone'];
            }
            if (isset($data['activities'])) {
                // Atribuir array diretamente - o cast 'array' do modelo fará a conversão para JSON
                $team->activities = $data['activities'];
            }
            if (isset($data['available_start'])) {
                $team->available_start = $data['available_start'] ?: null;
            }
            if (isset($data['available_end'])) {
                $team->available_end = $data['available_end'] ?: null;
            }
            if (isset($data['is_available'])) {
                $team->is_available = $data['is_available'];
            }
            
            $team->save();
            
            return $team->fresh();
        });
    }
}
