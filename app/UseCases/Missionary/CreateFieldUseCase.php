<?php

namespace App\UseCases\Missionary;

use App\Models\MissionaryField;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateFieldUseCase
{
    public function execute(User $user, array $data): MissionaryField
    {
        return DB::transaction(function () use ($user, $data) {
            $data['user_id'] = $user->id;
            $data['is_active'] = $data['is_active'] ?? true;

            return MissionaryField::create($data);
        });
    }
}
