<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\DeleteTeamUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VolunteerTeamController extends Controller
{
    public function __construct(
        private DeleteTeamUseCase $deleteTeamUseCase
    ) {}

    public function destroy(Request $request, VolunteerTeam $team): RedirectResponse
    {
        try {
            $this->deleteTeamUseCase->execute($team);
            
            return redirect()
                ->route('volunteer.dashboard')
                ->with('success', 'Equipe excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
