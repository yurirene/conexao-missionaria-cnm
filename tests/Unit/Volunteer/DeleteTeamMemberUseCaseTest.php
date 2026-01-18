<?php

namespace Tests\Unit\Volunteer;

use App\Models\TeamMember;
use App\UseCases\Volunteer\DeleteTeamMemberUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTeamMemberUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private DeleteTeamMemberUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new DeleteTeamMemberUseCase();
    }

    public function test_exclui_membro(): void
    {
        $member = TeamMember::factory()->create(['name' => 'Membro a Excluir']);

        $result = $this->useCase->execute($member);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('team_members', ['id' => $member->id]);
    }

    public function test_retorna_true_ao_excluir(): void
    {
        $member = TeamMember::factory()->create();

        $result = $this->useCase->execute($member);

        $this->assertTrue($result);
    }
}
