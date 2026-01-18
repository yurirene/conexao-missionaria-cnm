<?php

namespace Tests\Unit\Volunteer;

use App\Models\TeamMember;
use App\UseCases\Volunteer\UpdateTeamMemberUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTeamMemberUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private UpdateTeamMemberUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new UpdateTeamMemberUseCase();
    }

    public function test_atualiza_dados_do_membro(): void
    {
        $member = TeamMember::factory()->create([
            'name' => 'Nome Antigo',
            'phone' => '11999990000',
            'role' => 'Membro',
        ]);

        $data = [
            'name' => 'Nome Atualizado',
            'phone' => '11888881111',
            'church' => 'Nova Igreja',
            'role' => 'Líder',
        ];

        $updated = $this->useCase->execute($member, $data);

        $this->assertEquals('Nome Atualizado', $updated->name);
        $this->assertEquals('11888881111', $updated->phone);
        $this->assertEquals('Nova Igreja', $updated->church);
        $this->assertEquals('Líder', $updated->role);
    }

    public function test_converte_string_vazia_em_null(): void
    {
        $member = TeamMember::factory()->create([
            'phone' => '11999990000',
            'church' => 'Igreja X',
        ]);

        $data = [
            'name' => $member->name,
            'phone' => '',
            'church' => '',
        ];

        $updated = $this->useCase->execute($member, $data);

        $this->assertNull($updated->phone);
        $this->assertNull($updated->church);
    }
}
