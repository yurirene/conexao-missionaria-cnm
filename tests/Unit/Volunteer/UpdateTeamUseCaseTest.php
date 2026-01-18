<?php

namespace Tests\Unit\Volunteer;

use App\Models\User;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\UpdateTeamUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTeamUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private UpdateTeamUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new UpdateTeamUseCase();
    }

    public function test_atualiza_campos_da_equipe(): void
    {
        $team = VolunteerTeam::factory()->create([
            'church_name' => 'Igreja Antiga',
            'responsible_officer' => 'Pastor Antigo',
            'is_available' => true,
        ]);

        $data = [
            'church_name' => 'Igreja Atualizada',
            'responsible_officer' => 'Pastor Novo',
            'responsible_officer_phone' => '11777777777',
            'activities' => ['music', 'sports'],
            'is_available' => false,
        ];

        $updated = $this->useCase->execute($team, $data);

        $this->assertEquals('Igreja Atualizada', $updated->church_name);
        $this->assertEquals('Pastor Novo', $updated->responsible_officer);
        $this->assertEquals('11777777777', $updated->responsible_officer_phone);
        $this->assertEquals(['music', 'sports'], $updated->activities);
        $this->assertFalse($updated->is_available);
    }

    public function test_atualiza_apenas_campos_informados(): void
    {
        $team = VolunteerTeam::factory()->create([
            'church_name' => 'Igreja Original',
            'responsible_officer' => 'Pastor Original',
        ]);

        $data = ['church_name' => 'Só Nome Alterado'];

        $updated = $this->useCase->execute($team, $data);

        $this->assertEquals('Só Nome Alterado', $updated->church_name);
        $this->assertEquals('Pastor Original', $updated->responsible_officer);
    }
}
