<?php

namespace App\UseCases\Volunteer;

use App\Models\TeamMember;
use Illuminate\Support\Facades\DB;

class DeleteTeamMemberUseCase
{
    public function execute(TeamMember $member): bool
    {
        return DB::transaction(function () use ($member) {
            return (bool) $member->delete();
        });
    }
}
