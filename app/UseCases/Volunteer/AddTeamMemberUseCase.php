<?php

namespace App\UseCases\Volunteer;

use App\Enums\MemberStatus;
use App\Models\TeamMember;
use App\Models\VolunteerTeam;
use Illuminate\Support\Facades\DB;

class AddTeamMemberUseCase
{
    public function execute(VolunteerTeam $team, array $data): TeamMember
    {
        return DB::transaction(function () use ($team, $data) {
            // Preparar dados, convertendo arrays para JSON
            $attributes = [
                'team_id' => $team->id,
                'name' => $data['name'],
                'phone' => $data['phone'] ?? null,
                'church' => $data['church'] ?? null,
                'pastor_name' => $data['pastor_name'] ?? null,
                'pastor_phone' => $data['pastor_phone'] ?? null,
                'role' => $data['role'] ?? null,
                'photo_path' => $data['photo_path'] ?? null,
                'description' => $data['description'] ?? null,
                'specialty' => $data['specialty'] ?? null,
            ];
            
            // Converter status enum para string
            $status = $data['status'] ?? MemberStatus::PENDING;
            $attributes['status'] = $status instanceof MemberStatus ? $status->value : $status;
            
            $filePaths = $data['file_paths'] ?? [];
            $attributes['file_paths'] = !empty($filePaths) ? $filePaths : null;
            
            // Usar create com os atributos já convertidos
            $member = TeamMember::create($attributes);
            
            return $member->fresh();
        });
    }
}
