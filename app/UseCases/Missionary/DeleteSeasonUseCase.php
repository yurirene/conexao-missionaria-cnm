<?php

namespace App\UseCases\Missionary;

use App\Models\Season;
use Illuminate\Support\Facades\DB;

class DeleteSeasonUseCase
{
    public function execute(Season $season): bool
    {
        return DB::transaction(function () use ($season) {
            return $season->delete();
        });
    }
}
