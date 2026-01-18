<?php

namespace Tests\Unit\Volunteer;

use App\Enums\ConnectionStatus;
use App\Models\Connection;
use App\Models\MissionaryField;
use App\Models\Season;
use App\Models\User;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\SendConnectionRequestUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SendConnectionRequestUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private SendConnectionRequestUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new SendConnectionRequestUseCase();
    }

    public function test_cria_solicitacao_de_conexao(): void
    {
        $team = VolunteerTeam::factory()->create();
        $field = MissionaryField::create([
            'user_id' => User::factory()->create(['profile_type' => 'missionary'])->id,
            'name' => 'Campo Teste',
            'is_active' => true,
        ]);

        $connection = $this->useCase->execute($team, $field);

        $this->assertEquals($field->id, $connection->missionary_field_id);
        $this->assertEquals($team->id, $connection->volunteer_team_id);
        $this->assertEquals(ConnectionStatus::SENT, $connection->status);
        $this->assertEquals('volunteer', $connection->initiator_type);
        $this->assertDatabaseHas('connections', [
            'missionary_field_id' => $field->id,
            'volunteer_team_id' => $team->id,
        ]);
    }

    public function test_cria_conexao_com_season_id_opcional(): void
    {
        $team = VolunteerTeam::factory()->create();
        $field = MissionaryField::create([
            'user_id' => User::factory()->create(['profile_type' => 'missionary'])->id,
            'name' => 'Campo',
            'is_active' => true,
        ]);
        $season = Season::create([
            'missionary_field_id' => $field->id,
        ]);

        $connection = $this->useCase->execute($team, $field, $season->id);

        $this->assertEquals($season->id, $connection->season_id);
    }

    public function test_lanca_excecao_se_ja_existe_conexao_aceita(): void
    {
        $team = VolunteerTeam::factory()->create();
        $field = MissionaryField::create([
            'user_id' => User::factory()->create(['profile_type' => 'missionary'])->id,
            'name' => 'Campo',
            'is_active' => true,
        ]);

        Connection::create([
            'missionary_field_id' => $field->id,
            'volunteer_team_id' => $team->id,
            'status' => ConnectionStatus::ACCEPTED,
            'initiator_type' => 'volunteer',
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Já existe uma conexão entre esta equipe e este campo.');

        $this->useCase->execute($team, $field);
    }

    public function test_permite_nova_solicitacao_se_conexao_anterior_nao_esta_aceita(): void
    {
        $team = VolunteerTeam::factory()->create();
        $field = MissionaryField::create([
            'user_id' => User::factory()->create(['profile_type' => 'missionary'])->id,
            'name' => 'Campo',
            'is_active' => true,
        ]);

        Connection::create([
            'missionary_field_id' => $field->id,
            'volunteer_team_id' => $team->id,
            'status' => ConnectionStatus::SENT,
            'initiator_type' => 'volunteer',
        ]);

        $connection = $this->useCase->execute($team, $field);

        $this->assertNotNull($connection->id);
        $this->assertEquals(ConnectionStatus::SENT, $connection->status);
    }
}
