<?php

namespace Tests\Unit\Volunteer;

use App\Models\TeamMember;
use App\Services\SecureFileStorageService;
use App\UseCases\Volunteer\DeleteMemberFilesUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class DeleteMemberFilesUseCaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_chama_delete_directory_no_file_storage(): void
    {
        $member = TeamMember::factory()->create();
        $directory = "members/{$member->id}";

        $fileStorage = Mockery::mock(SecureFileStorageService::class);
        $fileStorage->shouldReceive('deleteDirectory')
            ->once()
            ->with($directory)
            ->andReturn(true);

        $useCase = new DeleteMemberFilesUseCase($fileStorage);
        $useCase->execute($member);

        $this->addToAssertionCount(1); // Mockery::close() verifica as expectativas do shouldReceive
        Mockery::close();
    }

    public function test_passar_diretorio_correto_para_o_membro(): void
    {
        $member = TeamMember::factory()->create();
        $expectedPath = "members/{$member->id}";
        $capturedPath = null;

        $fileStorage = Mockery::mock(SecureFileStorageService::class);
        $fileStorage->shouldReceive('deleteDirectory')
            ->once()
            ->withArgs(function (string $path) use (&$capturedPath, $expectedPath) {
                $capturedPath = $path;
                return $path === $expectedPath;
            })
            ->andReturn(true);

        $useCase = new DeleteMemberFilesUseCase($fileStorage);
        $useCase->execute($member);

        $this->assertSame($expectedPath, $capturedPath);
        Mockery::close();
    }
}
