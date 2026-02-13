<?php

namespace App\UseCases\Missionary;

use App\Models\VolunteerTeam;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class SearchTeamsUseCase
{
    public function execute(array $filters = [], ?string $excludeFieldId = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = VolunteerTeam::query()
            ->where('is_available', true)
            ->with('user', 'members');

        // Excluir equipes que já têm conexão aceita com este campo
        if ($excludeFieldId) {
            $query->whereDoesntHave('connections', function (Builder $q) use ($excludeFieldId) {
                $q->where('missionary_field_id', $excludeFieldId)
                  ->where('status', \App\Enums\ConnectionStatus::ACCEPTED);
            });
        }

        // Filtro por especialidades (atividades)
        if (!empty($filters['activities'])) {
            $activities = is_array($filters['activities']) ? $filters['activities'] : [$filters['activities']];
            $query->where(function (Builder $q) use ($activities) {
                foreach ($activities as $activity) {
                    $q->orWhereJsonContains('activities', $activity);
                }
            });
        }

        // Filtro por localização (se implementado)
        if (!empty($filters['location'])) {
            // Implementar filtro de localização se necessário
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
