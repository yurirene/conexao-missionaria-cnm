<?php

namespace App\Models;

use App\Enums\ProfileType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_type' => ProfileType::class,
        ];
    }

    // Relacionamentos
    public function missionaryField()
    {
        return $this->hasOne(MissionaryField::class);
    }

    public function volunteerTeam()
    {
        return $this->hasOne(VolunteerTeam::class);
    }

    // Métodos auxiliares
    public function isAdmin(): bool
    {
        return $this->profile_type === ProfileType::ADMIN;
    }

    public function isMissionary(): bool
    {
        return $this->profile_type === ProfileType::MISSIONARY;
    }

    public function isVolunteer(): bool
    {
        return $this->profile_type === ProfileType::VOLUNTEER;
    }
}
