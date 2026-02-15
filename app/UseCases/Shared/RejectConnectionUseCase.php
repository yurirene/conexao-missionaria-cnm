<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\DB;

class RejectConnectionUseCase
{
    public function execute(Connection $connection): Connection
    {
        return DB::transaction(function () use ($connection) {
            // Validar transição de status
            if (!$connection->status->canTransitionTo(ConnectionStatus::REJECTED)) {
                throw new \Exception('Não é possível rejeitar esta conexão no status atual.');
            }

            // Atualizar status
            $connection->update(['status' => ConnectionStatus::REJECTED]);

            return $connection->fresh();
        });
    }
}
