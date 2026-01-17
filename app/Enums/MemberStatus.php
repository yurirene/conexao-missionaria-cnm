<?php

namespace App\Enums;

enum MemberStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pendente',
            self::PAID => 'Pago',
            self::REJECTED => 'Rejeitado',
        };
    }
}
