<?php

namespace Tests\Unit\Volunteer;

use App\Models\User;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\DeleteTeamUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTeamUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private DeleteTeamUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new DeleteTeamUseCase();
    }

    public function test_exclui_equipe_quando_usuario_e_dono(): void
    {
        $user = User::factory()->create(['profile_type' => 'volunteer']);
        $team = VolunteerTeam::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $result = $this->useCase->execute($team);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('volunteer_teams', ['id' => $team->id]);
    }

    public function test_lanca_excecao_quando_usuario_nao_e_dono(): void
    {
        $owner = User::factory()->create(['profile_type' => 'volunteer']);
        $otherUser = User::factory()->create(['profile_type' => 'volunteer']);
        $team = VolunteerTeam::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($otherUser);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Você não tem permissão para excluir esta equipe.');

        $this->useCase->execute($team);
    }
}
