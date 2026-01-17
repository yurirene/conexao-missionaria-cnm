<?php

namespace App\UseCases\Volunteer;

use App\Models\Connection;
use App\Models\MissionaryField;
use App\Models\VolunteerTeam;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\DB;

class SendConnectionRequestUseCase
{
    public function execute(VolunteerTeam $team, MissionaryField $field, ?string $seasonId = null): Connection
    {
        return DB::transaction(function () use ($team, $field, $seasonId) {
            // Verificar se já existe conexão
            $existing = Connection::where('missionary_field_id', $field->id)
                ->where('status', ConnectionStatus::ACCEPTED)
                ->where('volunteer_team_id', $team->id)
                ->first();

            if ($existing) {
                throw new \Exception('Já existe uma conexão entre esta equipe e este campo.');
            }

            return Connection::create([
                'missionary_field_id' => $field->id,
                'volunteer_team_id' => $team->id,
                'season_id' => $seasonId,
                'status' => ConnectionStatus::SENT,
                'initiator_type' => 'volunteer',
            ]);
        });
    }
}
