<?php

namespace App\Observers;

use App\Models\MissionaryField;
use App\Services\NotificationService;

class MissionaryFieldObserver
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function created(MissionaryField $field): void
    {
        // RN02: Notificar admin quando novo campo é criado
        $this->notificationService->notifyAdminNewField($field->user);
    }
}
