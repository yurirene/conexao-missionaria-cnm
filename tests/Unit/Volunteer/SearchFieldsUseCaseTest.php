<?php

namespace Tests\Unit\Volunteer;

use App\Models\MissionaryField;
use App\Models\User;
use App\UseCases\Volunteer\SearchFieldsUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchFieldsUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private SearchFieldsUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new SearchFieldsUseCase();
    }

    public function test_retorna_apenas_campos_ativos(): void
    {
        $user = User::factory()->create(['profile_type' => 'missionary']);
        MissionaryField::create([
            'user_id' => $user->id,
            'name' => 'Campo Ativo',
            'is_active' => true,
        ]);
        MissionaryField::create([
            'user_id' => $user->id,
            'name' => 'Campo Inativo',
            'is_active' => false,
        ]);

        $result = $this->useCase->execute([], 15);

        $this->assertCount(1, $result->items());
        $this->assertEquals('Campo Ativo', $result->first()->name);
    }

    public function test_retorna_paginacao(): void
    {
        $result = $this->useCase->execute([], 10);

        $this->assertEquals(10, $result->perPage());
    }

    public function test_filtra_por_activities_quando_informado(): void
    {
        $user = User::factory()->create(['profile_type' => 'missionary']);
        MissionaryField::create([
            'user_id' => $user->id,
            'name' => 'Campo com Evangelismo',
            'activity_types' => ['evangelism', 'education'],
            'is_active' => true,
        ]);
        MissionaryField::create([
            'user_id' => $user->id,
            'name' => 'Campo só Música',
            'activity_types' => ['music'],
            'is_active' => true,
        ]);

        $result = $this->useCase->execute(['activities' => ['evangelism']], 15);

        $this->assertGreaterThanOrEqual(1, $result->count());
        $nomes = $result->pluck('name')->toArray();
        $this->assertContains('Campo com Evangelismo', $nomes);
    }
}
