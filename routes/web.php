<?php

use App\Http\Controllers\SecureDocumentController;
use App\Livewire\Missionary\Dashboard as MissionaryDashboard;
use App\Livewire\Missionary\FieldForm;
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

// Rotas públicas de autenticação
require __DIR__.'/auth.php';

// Rotas autenticadas
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isMissionary()) {
            return redirect()->route('missionary.dashboard');
        } elseif ($user->isVolunteer()) {
            return redirect()->route('volunteer.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    // Rotas Missionário
    Route::middleware(['profile:missionary'])->prefix('missionary')->name('missionary.')->group(function () {
        Route::get('/', MissionaryDashboard::class)->name('dashboard');
        Route::get('/field', FieldForm::class)->name('field.create');
        Route::get('/field/{field}', FieldForm::class)->name('field.edit');
    });

    // Rotas Voluntário
    Route::middleware(['profile:volunteer'])->prefix('volunteer')->name('volunteer.')->group(function () {
        // Adicionar rotas do voluntário aqui
    });

    // Rotas Admin
    Route::middleware(['profile:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Adicionar rotas do admin aqui
    });

    // Documentos seguros
    Route::get('/documents/{memberId}/{documentKey}', [SecureDocumentController::class, 'download'])
        ->name('documents.download')
        ->middleware('auth');
});
