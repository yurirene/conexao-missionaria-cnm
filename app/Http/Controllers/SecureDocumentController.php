<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\UseCases\Shared\DownloadSecureDocumentUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SecureDocumentController extends Controller
{
    public function __construct(
        private DownloadSecureDocumentUseCase $downloadUseCase
    ) {}

    public function download(Request $request, string $memberId, string $documentKey): StreamedResponse
    {
        $member = TeamMember::findOrFail($memberId);
        $filePath = $this->downloadUseCase->execute(auth()->user(), $member, $documentKey);

        return Storage::disk('private')->download($filePath);
    }
}
