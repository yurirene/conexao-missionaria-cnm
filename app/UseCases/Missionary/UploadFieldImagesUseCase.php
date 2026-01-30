<?php

namespace App\UseCases\Missionary;

use App\Models\MissionaryField;
use App\Models\MissionaryFieldImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFieldImagesUseCase
{
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/jpg',
        'image/webp',
    ];

    private const MAX_FILE_SIZE = 5120; // 5MB em KB

    public function execute(MissionaryField $field, array $images): MissionaryField
    {
        return DB::transaction(function () use ($field, $images) {
            $order = $field->images()->max('order') ?? 0;

            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    // Validar MIME type
                    if (!in_array($image->getMimeType(), self::ALLOWED_MIME_TYPES)) {
                        continue; // Pula imagens inválidas
                    }

                    // Validar tamanho
                    if ($image->getSize() > self::MAX_FILE_SIZE * 1024) {
                        continue; // Pula imagens muito grandes
                    }

                    // Gerar nome único
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $directory = "fields/{$field->id}";
                    $path = "{$directory}/{$filename}";

                    // Armazenar em storage/app/public (público para galeria)
                    Storage::disk('public')->putFileAs($directory, $image, $filename);

                    // Criar registro no banco
                    MissionaryFieldImage::create([
                        'missionary_field_id' => $field->id,
                        'image_path' => $path,
                        'order' => ++$order,
                    ]);
                }
            }

            return $field->fresh();
        });
    }
}
