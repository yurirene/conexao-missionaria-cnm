<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\DB;

class UpdateConnectionStatusUseCase
{
    public function execute(Connection $connection, ConnectionStatus $newStatus): Connection
    {
        return DB::transaction(function () use ($connection, $newStatus) {
            // Validar transição
            if (!$connection->status->canTransitionTo($newStatus)) {
                throw new \Exception("Não é possível transicionar de {$connection->status->value} para {$newStatus->value}.");
            }

            $connection->update(['status' => $newStatus]);
            return $connection->fresh();
        });
    }
}
