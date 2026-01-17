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
            $data['team_id'] = $team->id;
            $data['status'] = $data['status'] ?? MemberStatus::PENDING;

            return TeamMember::create($data);
        });
    }
}
