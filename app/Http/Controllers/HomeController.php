<?php

namespace App\Http\Controllers;

use App\Enums\ConnectionStatus;
use App\Models\Connection;
use App\Models\MissionaryField;
use App\Models\VolunteerTeam;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $totalMissionaryFields = MissionaryField::count();
        $totalVolunteerTeams = VolunteerTeam::count();
        $totalConnectionsRealized = Connection::where('status', ConnectionStatus::COMPLETED)->count();

        return view('home', [
            'totalMissionaryFields' => $totalMissionaryFields,
            'totalVolunteerTeams' => $totalVolunteerTeams,
            'totalConnectionsRealized' => $totalConnectionsRealized,
        ]);
    }
}
