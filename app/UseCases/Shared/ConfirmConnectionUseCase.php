<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\DB;

class ConfirmConnectionUseCase
{
    public function execute(Connection $connection): Connection
    {
        return DB::transaction(function () use ($connection) {
            // Validar transição de status
            if (!$connection->status->canTransitionTo(ConnectionStatus::CONFIRMED)) {
                throw new \Exception('Não é possível confirmar esta conexão no status atual.');
            }

            // Atualizar status
            $connection->update(['status' => ConnectionStatus::CONFIRMED]);

            return $connection->fresh();
        });
    }
}
