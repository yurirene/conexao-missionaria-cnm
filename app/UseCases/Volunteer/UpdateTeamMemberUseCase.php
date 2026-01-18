<?php

namespace App\UseCases\Volunteer;

use App\Models\TeamMember;
use Illuminate\Support\Facades\DB;

class UpdateTeamMemberUseCase
{
    public function execute(TeamMember $member, array $data): TeamMember
    {
        return DB::transaction(function () use ($member, $data) {
            $member->update([
                'name' => $data['name'],
                'phone' => ($data['phone'] ?? '') ?: null,
                'church' => ($data['church'] ?? '') ?: null,
                'pastor_name' => ($data['pastor_name'] ?? '') ?: null,
                'pastor_phone' => ($data['pastor_phone'] ?? '') ?: null,
                'role' => ($data['role'] ?? '') ?: null,
                'description' => ($data['description'] ?? '') ?: null,
                'specialty' => ($data['specialty'] ?? '') ?: null,
            ]);

            return $member->fresh();
        });
    }
}
