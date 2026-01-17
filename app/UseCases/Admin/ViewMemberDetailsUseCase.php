<?php

namespace App\UseCases\Admin;

use App\Models\TeamMember;

class ViewMemberDetailsUseCase
{
    public function execute(string $memberId): TeamMember
    {
        return TeamMember::with(['team.user', 'team.connections.missionaryField'])
            ->findOrFail($memberId);
    }
}
