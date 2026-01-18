<?php

namespace App\Livewire\Auth;

use App\Enums\ProfileType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Attributes\Layout;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $profile_type = 'volunteer';

    public function register()
    {
        $creator = app(CreatesNewUsers::class);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_type' => ['required', 'in:missionary,volunteer'],
        ]);

        $key = 'register_attempts_' . request()->ip();
        $attempts = cache()->get($key, 0);
        $maxAttempts = 3;
        $decay = now()->addMinutes(1);

        if ($attempts >= $maxAttempts) {
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas. Tente novamente em 5 minutos.'
            ]);
        }

        cache()->put($key, $attempts + 1, $decay);

        $user = $creator->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'profile_type' => $this->profile_type,
        ]);

        Auth::login($user);

        // Redirecionar para cadastro específico do perfil
        if ($this->profile_type === 'missionary') {
            return redirect()->route('missionary.field.create');
        } else {
            return redirect()->route('volunteer.team.create');
        }
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}