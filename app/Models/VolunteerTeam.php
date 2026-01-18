<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VolunteerTeam extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'church_name',
        'responsible_officer',
        'responsible_officer_phone',
        'activities',
        'available_start',
        'available_end',
        'is_available',
    ];

    protected $casts = [
        'activities' => 'array',
        'available_start' => 'date',
        'available_end' => 'date',
        'is_available' => 'boolean',
    ];

    // Relacionamentos
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class);
    }

    // Acessors
    public function getActivitiesListAttribute(): array
    {
        return $this->activities ?? [];
    }
}
