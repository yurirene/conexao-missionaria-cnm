<?php

namespace App\UseCases\Volunteer;

use App\Models\TeamMember;
use App\Services\SecureFileStorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class UploadMemberDocumentsUseCase
{
    public function __construct(
        private SecureFileStorageService $fileStorage
    ) {}

    public function execute(TeamMember $member, array $files): TeamMember
    {
        return DB::transaction(function () use ($member, $files) {
            $filePaths = $member->file_paths ?? [];

            foreach ($files as $key => $file) {
                if ($file instanceof UploadedFile) {
                    $path = $this->fileStorage->store($file, "members/{$member->id}");
                    $filePaths[$key] = $path;
                }
            }

            $member->update(['file_paths' => $filePaths]);
            return $member->fresh();
        });
    }
}
