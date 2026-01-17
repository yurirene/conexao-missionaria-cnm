<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'missionary_field_id',
        'start_date',
        'end_date',
        'vacancies',
        'desired_activities',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'desired_activities' => 'array',
        ];
    }

    // Relacionamentos
    public function missionaryField(): BelongsTo
    {
        return $this->belongsTo(MissionaryField::class);
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class);
    }
}
