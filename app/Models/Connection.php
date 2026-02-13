<?php

namespace App\Models;

use App\Enums\ConnectionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'missionary_field_id',
        'volunteer_team_id',
        'season_id',
        'status',
        'initiator_type',
    ];

    protected $casts = [
        'status' => ConnectionStatus::class,
    ];

    // Relacionamentos
    public function missionaryField(): BelongsTo
    {
        return $this->belongsTo(MissionaryField::class);
    }

    public function volunteerTeam(): BelongsTo
    {
        return $this->belongsTo(VolunteerTeam::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
