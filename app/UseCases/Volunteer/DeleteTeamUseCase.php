<?php

namespace App\UseCases\Volunteer;

use App\Models\VolunteerTeam;
use Illuminate\Support\Facades\DB;

class DeleteTeamUseCase
{
    public function execute(VolunteerTeam $team): bool
    {
        return DB::transaction(function () use ($team) {
            // Verificar se o usuário é o dono da equipe
            if ($team->user_id !== auth()->id()) {
                throw new \Exception('Você não tem permissão para excluir esta equipe.');
            }

            // Deletar a equipe (cascade vai deletar membros e conexões)
            return $team->delete();
        });
    }
}
