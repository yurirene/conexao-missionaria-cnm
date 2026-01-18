<?php

namespace Tests\Unit\Volunteer;

use App\Enums\MemberStatus;
use App\Models\TeamMember;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\AddTeamMemberUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddTeamMemberUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private AddTeamMemberUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new AddTeamMemberUseCase();
    }

    public function test_adiciona_membro_com_dados_minimos(): void
    {
        $team = VolunteerTeam::factory()->create();

        $data = ['name' => 'Maria Silva'];

        $member = $this->useCase->execute($team, $data);

        $this->assertInstanceOf(TeamMember::class, $member);
        $this->assertEquals($team->id, $member->team_id);
        $this->assertEquals('Maria Silva', $member->name);
        $this->assertNull($member->phone);
        $this->assertEquals(MemberStatus::PENDING, $member->status);
        $this->assertDatabaseHas('team_members', ['name' => 'Maria Silva']);
    }

    public function test_adiciona_membro_com_dados_completos(): void
    {
        $team = VolunteerTeam::factory()->create();

        $data = [
            'name' => 'João Santos',
            'phone' => '11999998888',
            'church' => 'Igreja Central',
            'pastor_name' => 'Pastor José',
            'pastor_phone' => '11888887777',
            'role' => 'Líder',
            'description' => 'Membro ativo',
            'specialty' => 'Música',
            'status' => MemberStatus::PAID,
        ];

        $member = $this->useCase->execute($team, $data);

        $this->assertEquals('João Santos', $member->name);
        $this->assertEquals('11999998888', $member->phone);
        $this->assertEquals('Igreja Central', $member->church);
        $this->assertEquals('Líder', $member->role);
        $this->assertEquals(MemberStatus::PAID, $member->status);
    }

    public function test_adiciona_membro_com_file_paths(): void
    {
        $team = VolunteerTeam::factory()->create();

        $data = [
            'name' => 'Ana Costa',
            'file_paths' => [
                'pastoral_authorization' => 'members/xxx/auth.pdf',
                'lgpd' => 'members/xxx/lgpd.pdf',
            ],
        ];

        $member = $this->useCase->execute($team, $data);

        $this->assertIsArray($member->file_paths);
        $this->assertArrayHasKey('pastoral_authorization', $member->file_paths);
        $this->assertArrayHasKey('lgpd', $member->file_paths);
    }
}
