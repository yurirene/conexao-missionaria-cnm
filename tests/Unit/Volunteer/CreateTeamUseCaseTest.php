<?php

namespace Tests\Unit\Volunteer;

use App\Models\User;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\CreateTeamUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTeamUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateTeamUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new CreateTeamUseCase();
    }

    public function test_cria_equipe_com_dados_minimos(): void
    {
        $user = User::factory()->create(['profile_type' => 'volunteer']);

        $data = [
            'church_name' => 'Igreja Teste',
            'responsible_officer' => 'Pastor João',
            'responsible_officer_phone' => '11999999999',
        ];

        $team = $this->useCase->execute($user, $data);

        $this->assertInstanceOf(VolunteerTeam::class, $team);
        $this->assertEquals($user->id, $team->user_id);
        $this->assertEquals('Igreja Teste', $team->church_name);
        $this->assertEquals('Pastor João', $team->responsible_officer);
        $this->assertEquals('11999999999', $team->responsible_officer_phone);
        $this->assertTrue($team->is_available);
        $this->assertNull($team->activities);
        $this->assertDatabaseHas('volunteer_teams', ['church_name' => 'Igreja Teste']);
    }

    public function test_cria_equipe_com_dados_completos(): void
    {
        $user = User::factory()->create(['profile_type' => 'volunteer']);

        $data = [
            'church_name' => 'Igreja Nova',
            'responsible_officer' => 'Pastor Maria',
            'responsible_officer_phone' => '11888888888',
            'activities' => ['evangelism', 'education'],
            'available_start' => '2025-01-01',
            'available_end' => '2025-12-31',
            'is_available' => false,
        ];

        $team = $this->useCase->execute($user, $data);

        $this->assertEquals('Igreja Nova', $team->church_name);
        $this->assertEquals('2025-01-01', $team->available_start?->format('Y-m-d'));
        $this->assertEquals('2025-12-31', $team->available_end?->format('Y-m-d'));
        $this->assertFalse($team->is_available);
        $this->assertNotNull($team->activities);
    }
}
