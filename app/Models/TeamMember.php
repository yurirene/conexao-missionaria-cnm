<?php

namespace App\Models;

use App\Enums\MemberStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamMember extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'team_id',
        'name',
        'phone',
        'church',
        'pastor_name',
        'pastor_phone',
        'role',
        'photo_path',
        'description',
        'specialty',
        'status',
        'file_paths',
    ];

    protected $casts = [
        'status' => MemberStatus::class,
        'file_paths' => 'array',
    ];

    // Relacionamentos
    public function team(): BelongsTo
    {
        return $this->belongsTo(VolunteerTeam::class, 'team_id');
    }

    // Acessors
    public function getDocumentsAttribute(): array
    {
        return $this->file_paths ?? [];
    }
}
