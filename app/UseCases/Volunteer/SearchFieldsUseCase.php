<?php

namespace App\UseCases\Volunteer;

use App\Models\MissionaryField;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class SearchFieldsUseCase
{
    public function execute(array $filters = [], ?string $excludeTeamId = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = MissionaryField::query()
            ->where('is_active', true)
            ->with('user', 'seasons', 'images', 'connections');

        // Excluir campos que já têm conexão aceita com esta equipe
        if ($excludeTeamId) {
            $query->whereDoesntHave('connections', function (Builder $q) use ($excludeTeamId) {
                $q->where('volunteer_team_id', $excludeTeamId)
                  ->where('status', \App\Enums\ConnectionStatus::ACCEPTED);
            });
        }

        // Filtro por especialidades (atividades)
        if (!empty($filters['activities'])) {
            $activities = is_array($filters['activities']) ? $filters['activities'] : [$filters['activities']];
            $query->where(function (Builder $q) use ($activities) {
                foreach ($activities as $activity) {
                    $q->orWhereJsonContains('activity_types', $activity);
                }
            });
        }

        // Filtro por localização
        if (!empty($filters['location'])) {
            // Implementar filtro de localização se necessário
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
