<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionaryFieldImage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'missionary_field_id',
        'image_path',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    // Relacionamentos
    public function missionaryField(): BelongsTo
    {
        return $this->belongsTo(MissionaryField::class);
    }
}
