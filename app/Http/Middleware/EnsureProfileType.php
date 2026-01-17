<?php

namespace App\Http\Middleware;

use App\Enums\ProfileType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileType
{
    public function handle(Request $request, Closure $next, string ...$types): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $allowedTypes = array_map(fn($type) => ProfileType::from($type), $types);
        $userType = $user->profile_type;

        if (!in_array($userType, $allowedTypes)) {
            abort(403, 'Acesso negado para este perfil.');
        }

        return $next($request);
    }
}
