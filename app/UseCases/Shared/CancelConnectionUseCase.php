<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\DB;

class CancelConnectionUseCase
{
    public function execute(Connection $connection): Connection
    {
        return DB::transaction(function () use ($connection) {
            // Validar transição de status
            if (!$connection->status->canTransitionTo(ConnectionStatus::CANCELLED)) {
                throw new \Exception('Não é possível cancelar esta conexão no status atual.');
            }

            // Atualizar status
            $connection->update(['status' => ConnectionStatus::CANCELLED]);

            // Reativar campo e equipe após cancelamento para que possam buscar novas conexões
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
