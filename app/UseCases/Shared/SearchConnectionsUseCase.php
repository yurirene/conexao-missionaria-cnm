<?php

namespace App\UseCases\Shared;

use App\Models\Connection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class SearchConnectionsUseCase
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Connection::query()
            ->with(['missionaryField.user', 'volunteerTeam.user', 'season']);

        // Filtro por status
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Filtro por campo missionário
        if (!empty($filters['missionary_field_id'])) {
            $query->where('missionary_field_id', $filters['missionary_field_id']);
        }

        // Filtro por equipe voluntária
        if (!empty($filters['volunteer_team_id'])) {
            $query->where('volunteer_team_id', $filters['volunteer_team_id']);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
