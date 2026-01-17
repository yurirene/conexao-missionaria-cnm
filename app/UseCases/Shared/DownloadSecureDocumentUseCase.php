<?php

namespace App\UseCases\Shared;

use App\Models\TeamMember;
use App\Models\User;
use App\Services\SecureFileStorageService;
use Illuminate\Support\Facades\Storage;

class DownloadSecureDocumentUseCase
{
    public function __construct(
        private SecureFileStorageService $fileStorage
    ) {}

    public function execute(User $user, TeamMember $member, string $documentKey): ?string
    {
        // Verificar permissões (RN04)
        if (!$this->canAccessDocument($user, $member)) {
            throw new \Exception('Você não tem permissão para acessar este documento.');
        }

        $filePaths = $member->file_paths ?? [];
        $filePath = $filePaths[$documentKey] ?? null;

        if (!$filePath) {
            throw new \Exception('Documento não encontrado.');
        }

        $fullPath = $this->fileStorage->getPath($filePath);

        if (!Storage::disk('private')->exists($fullPath)) {
            throw new \Exception('Arquivo não encontrado no sistema.');
        }

        return $fullPath;
    }

    private function canAccessDocument(User $user, TeamMember $member): bool
    {
        // Admin pode acessar
        if ($user->isAdmin()) {
            return true;
        }

        // Líder da equipe pode acessar
        if ($user->id === $member->team->user_id) {
            return true;
        }

        // Dono do campo conectado pode acessar
        $connection = $member->team->connections()
            ->where('status', \App\Enums\ConnectionStatus::ACCEPTED)
            ->first();

        if ($connection && $connection->missionaryField && $connection->missionaryField->user_id === $user->id) {
            return true;
        }

        return false;
    }
}
