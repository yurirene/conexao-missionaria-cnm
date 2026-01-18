<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    public function boot()
    {
        // Configurar views do Fortify para usar Livewire
        // As rotas são gerenciadas em routes/auth.php usando Livewire diretamente
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });
        
        // Manter apenas a criação de usuários
        Fortify::createUsersUsing(CreateNewUser::class);

        // Você também pode definir as views para reset de senha, verificação de e-mail, etc.
        // Fortify::requestPasswordResetLinkView(function () {
        //     return view('auth.forgot-password');
        // });
        // Fortify::resetPasswordView(function () {
        //     return view('auth.reset-password');
        // });
        // Fortify::verifyEmailView(function () {
        //     return view('auth.verify-email');
        // });
        // Fortify::confirmPasswordView(function () {
        //     return view('auth.confirm-password');
        // });
    }
}
