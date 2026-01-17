<?php

namespace App\Enums;

enum ProfileType: string
{
    case ADMIN = 'admin';
    case MISSIONARY = 'missionary';
    case VOLUNTEER = 'volunteer';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador',
            self::MISSIONARY => 'Missionário',
            self::VOLUNTEER => 'Voluntário',
        };
    }
}
