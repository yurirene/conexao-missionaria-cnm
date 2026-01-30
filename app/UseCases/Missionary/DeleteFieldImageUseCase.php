<?php

namespace App\UseCases\Missionary;

use App\Models\MissionaryFieldImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteFieldImageUseCase
{
    public function execute(MissionaryFieldImage $image): bool
    {
        return DB::transaction(function () use ($image) {
            // Deletar arquivo físico
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Deletar registro do banco
            return $image->delete();
        });
    }
}
