<?php

namespace App\UseCases\Volunteer;

use App\Enums\MemberStatus;
use App\Models\TeamMember;
use Illuminate\Support\Facades\DB;

class UpdateMemberStatusUseCase
{
    public function execute(TeamMember $member, MemberStatus $status): TeamMember
    {
        return DB::transaction(function () use ($member, $status) {
            $member->update(['status' => $status]);
            return $member->fresh();
        });
    }
}
