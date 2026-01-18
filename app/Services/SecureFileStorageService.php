<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SecureFileStorageService
{
    private const ALLOWED_MIME_TYPES = [
        'application/pdf',
        'image/jpeg',
        'image/png',
        'image/jpg',
    ];

    public function store(UploadedFile $file, string $directory = 'documents'): string
    {
        // Validar MIME type
        if (!in_array($file->getMimeType(), self::ALLOWED_MIME_TYPES)) {
            throw new \Exception('Tipo de arquivo não permitido.');
        }

        // Gerar nome único
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        // Armazenar em storage/app/private (RN04)
        Storage::disk('private')->putFileAs($directory, $file, $filename);

        return $path;
    }

    public function delete(string $path): bool
    {
        return Storage::disk('private')->delete($path);
    }

    public function deleteDirectory(string $path): bool
    {
        return Storage::disk('private')->deleteDirectory($path);
    }

    public function getPath(string $path): string
    {
        return $path;
    }

    public function exists(string $path): bool
    {
        return Storage::disk('private')->exists($path);
    }
}
