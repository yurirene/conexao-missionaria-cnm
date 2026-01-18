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

    public function badge(): string
    {
        return match($this) {
            self::PENDING => 'badge bg-light-warning',
            self::PAID => 'badge bg-light-success',
            self::REJECTED => 'badge bg-light-danger',
        };
    }
}
