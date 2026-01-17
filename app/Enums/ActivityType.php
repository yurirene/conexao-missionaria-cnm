<?php

namespace App\Enums;

enum ActivityType: string
{
    case EVANGELISM = 'evangelism';
    case CONSTRUCTION = 'construction';
    case EDUCATION = 'education';
    case HEALTH = 'health';
    case SOCIAL = 'social';
    case MUSIC = 'music';
    case SPORTS = 'sports';
    case CHILDREN = 'children';
    case YOUTH = 'youth';
    case ADULTS = 'adults';
    case ELDERLY = 'elderly';
    case TEATHER = 'teather';

    public function label(): string
    {
        return match($this) {
            self::EVANGELISM => 'Evangelismo',
            self::CONSTRUCTION => 'Construção/Reparos',
            self::EDUCATION => 'Educação',
            self::HEALTH => 'Saúde',
            self::SOCIAL => 'Social',
            self::MUSIC => 'Música',
            self::SPORTS => 'Esportes',
            self::CHILDREN => 'Crianças',
            self::YOUTH => 'Jovens',
            self::ADULTS => 'Adultos',
            self::ELDERLY => 'Idosos',
            self::TEATHER => 'Teatro',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
