<?php

namespace App\Enums;

enum ConnectionStatus: string
{
    case SENT = 'sent';
    case RECEIVED = 'received';
    case ACCEPTED = 'accepted';
    case CONFIRMED = 'confirmed';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match($this) {
            self::SENT => 'Enviado',
            self::RECEIVED => 'Recebido',
            self::ACCEPTED => 'Aceito',
            self::CONFIRMED => 'Confirmado',
            self::REJECTED => 'Rejeitado',
            self::CANCELLED => 'Cancelado',
            self::COMPLETED => 'Concluído',
        };
    }

    public function canTransitionTo(ConnectionStatus $newStatus): bool
    {
        return match($this) {
            self::SENT => in_array($newStatus, [self::RECEIVED, self::ACCEPTED, self::REJECTED, self::CANCELLED]),
            self::RECEIVED => in_array($newStatus, [self::ACCEPTED, self::REJECTED, self::CANCELLED]),
            self::ACCEPTED => in_array($newStatus, [self::CONFIRMED, self::CANCELLED]),
            self::CONFIRMED => in_array($newStatus, [self::COMPLETED, self::CANCELLED]),
            self::REJECTED => false,
            self::CANCELLED => false,
            self::COMPLETED => false,
        };
    }
}
