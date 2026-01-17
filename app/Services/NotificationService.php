<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function notifyAdminNewField(User $fieldOwner): void
    {
        $admins = User::where('profile_type', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(
                new \App\Mail\NewFieldRegistered($fieldOwner)
            );
        }
    }

    public function notifyAdminNewTeam(User $teamOwner): void
    {
        $admins = User::where('profile_type', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(
                new \App\Mail\NewTeamRegistered($teamOwner)
            );
        }
    }
}
