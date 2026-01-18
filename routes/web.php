<?php

use App\Http\Controllers\SecureDocumentController;
use App\Livewire\Missionary\Dashboard as MissionaryDashboard;
use App\Livewire\Missionary\FieldForm;
use App\Livewire\Volunteer\Dashboard as VolunteerDashboard;
use App\Livewire\Volunteer\TeamForm;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('site');
})->name('home');

Route::get('/logout-teste', function () {
    Auth::logout();
    
    return redirect()->route('home');
});

// Rotas públicas de autenticação
require __DIR__.'/auth.php';

// Rotas autenticadas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isMissionary()) {
            // Verificar se já tem campo cadastrado
            if (!$user->missionaryField) {
                return redirect()->route('missionary.field.create');
            }
            return redirect()->route('missionary.dashboard');
        } elseif ($user->isVolunteer()) {
            // Verificar se já tem equipe cadastrada
            if (!$user->volunteerTeam) {
                return redirect()->route('volunteer.team.create');
            }
            return redirect()->route('volunteer.dashboard');
        }
        
        return redirect()->route('home');
    })->name('dashboard');

    // Rotas Missionário
    Route::prefix('missionary')->name('missionary.')->group(function () {
        Route::get('/', MissionaryDashboard::class)
            ->middleware('profile:missionary')
            ->name('dashboard');
        Route::get('/field', FieldForm::class)
            ->middleware('profile:missionary')
            ->name('field.create');
        Route::get('/field/{field}', FieldForm::class)
            ->middleware('profile:missionary')
            ->name('field.edit');
    });

    // Rotas Voluntário - IMPORTANTE: ordem das rotas (mais específicas primeiro)
    Route::prefix('volunteer')->name('volunteer.')->middleware('profile:volunteer')->group(function () {
        Route::get('/', VolunteerDashboard::class)->name('dashboard');
        Route::get('/team', TeamForm::class)->name('team.create');
        Route::get('/team/{team}', TeamForm::class)->name('team.edit');
        Route::delete('/team/{team}', [\App\Http\Controllers\Volunteer\VolunteerTeamController::class, 'destroy'])->name('team.destroy');
    });

    // Rotas Admin
    Route::middleware(['profile:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Adicionar rotas do admin aqui
    });

    // Documentos seguros
    Route::get('/documents/{memberId}/{documentKey}', [SecureDocumentController::class, 'download'])
        ->name('documents.download');
});

// Rotas que requerem verificação de email
Route::middleware(['auth', 'verified'])->group(function () {
    // Adicionar rotas que realmente precisam de email verificado aqui
});
