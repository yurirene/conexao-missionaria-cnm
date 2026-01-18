<?php

namespace Tests\Unit\Volunteer;

use App\Enums\MemberStatus;
use App\Models\TeamMember;
use App\UseCases\Volunteer\UpdateMemberStatusUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateMemberStatusUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private UpdateMemberStatusUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new UpdateMemberStatusUseCase();
    }

    public function test_atualiza_status_para_pago(): void
    {
        $member = TeamMember::factory()->create(['status' => MemberStatus::PENDING]);

        $updated = $this->useCase->execute($member, MemberStatus::PAID);

        $this->assertEquals(MemberStatus::PAID, $updated->status);
    }

    public function test_atualiza_status_para_rejeitado(): void
    {
        $member = TeamMember::factory()->create(['status' => MemberStatus::PENDING]);

        $updated = $this->useCase->execute($member, MemberStatus::REJECTED);

        $this->assertEquals(MemberStatus::REJECTED, $updated->status);
    }
}
