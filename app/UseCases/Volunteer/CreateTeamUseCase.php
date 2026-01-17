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
            $data['user_id'] = $user->id;
            $data['is_available'] = $data['is_available'] ?? true;

            return VolunteerTeam::create($data);
        });
    }
}
