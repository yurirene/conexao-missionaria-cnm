<?php

namespace App\UseCases\Volunteer;

use App\Models\User;
use App\Models\VolunteerTeam;
use Illuminate\Support\Facades\DB;

class CreateTeamUseCase
{
    public function execute(User $user, array $data): VolunteerTeam
    {
        return DB::transaction(function () use ($user, $data) {
            // Preparar dados, convertendo array para JSON
            $attributes = [
                'user_id' => $user->id,
                'church_name' => $data['church_name'],
                'responsible_officer' => $data['responsible_officer'],
                'responsible_officer_phone' => $data['responsible_officer_phone'] ?? null,
                'available_start' => $data['available_start'] ?? null,
                'available_end' => $data['available_end'] ?? null,
                'is_available' => $data['is_available'] ?? true,
            ];
            
            // Converter activities array para JSON string antes de criar
            $activities = $data['activities'] ?? [];
            $attributes['activities'] = !empty($activities) ? json_encode($activities) : null;
            
            // Usar create com os atributos já convertidos
            $team = VolunteerTeam::create($attributes);
            
            return $team->fresh();
        });
    }
}
