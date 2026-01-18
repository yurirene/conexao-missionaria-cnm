<?php

namespace App\UseCases\Volunteer;

use App\Models\TeamMember;
use App\Services\SecureFileStorageService;

class DeleteMemberFilesUseCase
{
    public function __construct(
        private SecureFileStorageService $fileStorage
    ) {}

    /**
     * Remove do storage todos os arquivos vinculados ao membro.
     * Os arquivos são armazenados em members/{member->id}/ (conforme UploadMemberDocumentsUseCase).
     */
    public function execute(TeamMember $member): void
    {
        $directory = "members/{$member->id}";
        $this->fileStorage->deleteDirectory($directory);
    }
}
