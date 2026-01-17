<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use App\Enums\ConnectionStatus;
use App\Services\WhatsAppNotificationService;
use Illuminate\Support\Facades\DB;

class AcceptConnectionUseCase
{
    public function __construct(
        private ?WhatsAppNotificationService $whatsAppService = null
    ) {
        $this->whatsAppService = $whatsAppService ?? app(WhatsAppNotificationService::class);
    }

    public function execute(Connection $connection): Connection
    {
        return DB::transaction(function () use ($connection) {
            // Validar transição de status
            if (!$connection->status->canTransitionTo(ConnectionStatus::ACCEPTED)) {
                throw new \Exception('Não é possível aceitar esta conexão no status atual.');
            }

            // Atualizar status
            $connection->update(['status' => ConnectionStatus::ACCEPTED]);

            // RN01: Ocultar automaticamente após aceitar
            if ($connection->missionaryField) {
                $connection->missionaryField->update(['is_active' => false]);
            }
            if ($connection->volunteerTeam) {
                $connection->volunteerTeam->update(['is_available' => false]);
            }

            // RN03: Notificação WhatsApp
            $this->whatsAppService->sendConnectionAcceptedNotification($connection);

            return $connection->fresh();
        });
    }
}
