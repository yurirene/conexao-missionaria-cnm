<?php

namespace App\UseCases\Admin;

use App\Models\VolunteerTeam;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ListTeamsUseCase
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = VolunteerTeam::query()
            ->with('user', 'members');

        // Filtro por disponibilidade
        if (isset($filters['is_available'])) {
            $query->where('is_available', $filters['is_available']);
        }

        // Filtro por igreja
        if (!empty($filters['church_name'])) {
            $query->where('church_name', 'like', "%{$filters['church_name']}%");
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
