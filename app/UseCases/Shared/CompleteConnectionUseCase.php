<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\DB;

class CompleteConnectionUseCase
{
    public function execute(Connection $connection): Connection
    {
        return DB::transaction(function () use ($connection) {
            // Validar transição de status
            if (!$connection->status->canTransitionTo(ConnectionStatus::COMPLETED)) {
                throw new \Exception('Não é possível concluir esta conexão no status atual.');
            }

            // Atualizar status
            $connection->update(['status' => ConnectionStatus::COMPLETED]);

            // RN01: Reativar campo e equipe após conclusão para nova missão
            if ($connection->missionaryField) {
                $connection->missionaryField->update(['is_active' => true]);
            }
            if ($connection->volunteerTeam) {
                $connection->volunteerTeam->update(['is_available' => true]);
            }

            return $connection->fresh();
        });
    }
}
