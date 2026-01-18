<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MissionaryField extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'location_data',
        'description',
        'structure',
        'office_hours',
        'activity_types',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'location_data' => 'array',
            'activity_types' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Garante que activity_types (JSON) seja sempre gravado como string no banco.
     * Evita "Array to string conversion" em alguns ambientes MySQL.
     */
    protected function setActivityTypesAttribute($value): void
    {
        $this->attributes['activity_types'] = \is_array($value) ? json_encode($value) : $value;
    }

    // Relacionamentos
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(MissionaryFieldImage::class);
    }

    // Acessors
    public function getLocationAttribute(): ?array
    {
        return $this->location_data;
    }

    public function getActivitiesAttribute(): array
    {
        return $this->activity_types ?? [];
    }
}
