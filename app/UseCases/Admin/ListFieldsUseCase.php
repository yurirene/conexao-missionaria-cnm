<?php

namespace App\UseCases\Admin;

use App\Models\MissionaryField;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ListFieldsUseCase
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = MissionaryField::query()
            ->with('user', 'seasons', 'images');

        // Filtro por status
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        // Filtro por nome
        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
