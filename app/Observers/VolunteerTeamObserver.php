<?php

namespace App\Observers;

use App\Models\VolunteerTeam;
use App\Services\NotificationService;

class VolunteerTeamObserver
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function created(VolunteerTeam $team): void
    {
        // RN02: Notificar admin quando nova equipe é criada
        $this->notificationService->notifyAdminNewTeam($team->user);
    }
}
