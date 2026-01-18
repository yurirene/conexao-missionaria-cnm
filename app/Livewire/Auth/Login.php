<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Responses\LoginResponse;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function mount()
    {
        // Redireciona se o usuário já estiver logado
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isMissionary()) {
                if (!$user->missionaryField) {
                    return redirect()->route('missionary.field.create');
                }
                return redirect()->route('missionary.dashboard');
            } elseif ($user->isVolunteer()) {
                if (!$user->volunteerTeam) {
                    return redirect()->route('volunteer.team.create');
                }
                return redirect()->route('volunteer.dashboard');
            }
            return redirect()->route('dashboard');
        }
    }

    public function authenticate()
    {
        $this->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request = request();
        $request->session()->regenerate();

        // Redirecionar para dashboard específico do perfil
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isMissionary()) {
            if (!$user->missionaryField) {
                return redirect()->route('missionary.field.create');
            }
            return redirect()->route('missionary.dashboard');
        } elseif ($user->isVolunteer()) {
            if (!$user->volunteerTeam) {
                return redirect()->route('volunteer.team.create');
            }
            return redirect()->route('volunteer.dashboard');
        }

        return redirect()->route('dashboard');
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}