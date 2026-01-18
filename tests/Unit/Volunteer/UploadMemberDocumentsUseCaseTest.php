<?php

namespace Tests\Unit\Volunteer;

use App\Models\TeamMember;
use App\Services\SecureFileStorageService;
use App\UseCases\Volunteer\UploadMemberDocumentsUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class UploadMemberDocumentsUseCaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('private');
    }

    public function test_atualiza_file_paths_quando_recebe_arquivo(): void
    {
        $member = TeamMember::factory()->create(['file_paths' => null]);
        $file = UploadedFile::fake()->create('documento.pdf', 100, 'application/pdf');

        $fileStorage = Mockery::mock(SecureFileStorageService::class);
        $fileStorage->shouldReceive('store')
            ->once()
            ->withArgs(function ($f, $dir) use ($member) {
                return $dir === "members/{$member->id}";
            })
            ->andReturn("members/{$member->id}/uuid.pdf");

        $useCase = new UploadMemberDocumentsUseCase($fileStorage);
        $updated = $useCase->execute($member, ['pastoral_authorization' => $file]);

        $this->assertArrayHasKey('pastoral_authorization', $updated->file_paths);
        $this->assertEquals("members/{$member->id}/uuid.pdf", $updated->file_paths['pastoral_authorization']);

        Mockery::close();
    }

    public function test_ignora_entradas_que_nao_sao_uploaded_file(): void
    {
        $member = TeamMember::factory()->create(['file_paths' => ['lgpd' => 'path/existente']]);

        $fileStorage = Mockery::mock(SecureFileStorageService::class);
        $fileStorage->shouldNotReceive('store');

        $useCase = new UploadMemberDocumentsUseCase($fileStorage);
        $updated = $useCase->execute($member, ['invalid_key' => 'string']);

        $this->assertEquals(['lgpd' => 'path/existente'], $updated->file_paths);

        Mockery::close();
    }

    public function test_merge_novos_arquivos_com_file_paths_existentes(): void
    {
        $member = TeamMember::factory()->create([
            'file_paths' => ['lgpd' => 'members/xxx/lgpd.pdf'],
        ]);
        $file = UploadedFile::fake()->create('auth.pdf', 100, 'application/pdf');

        $fileStorage = Mockery::mock(SecureFileStorageService::class);
        $fileStorage->shouldReceive('store')
            ->once()
            ->andReturn("members/{$member->id}/auth.pdf");

        $useCase = new UploadMemberDocumentsUseCase($fileStorage);
        $updated = $useCase->execute($member, ['pastoral_authorization' => $file]);

        $this->assertArrayHasKey('lgpd', $updated->file_paths);
        $this->assertArrayHasKey('pastoral_authorization', $updated->file_paths);

        Mockery::close();
    }
}
