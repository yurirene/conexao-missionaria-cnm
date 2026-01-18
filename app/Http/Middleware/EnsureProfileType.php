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

        // Converter tipos permitidos para enums
        $allowedTypes = array_map(function($type) {
            try {
                return ProfileType::from($type);
            } catch (\ValueError $e) {
                abort(500, "Tipo de perfil inválido na rota: {$type}");
            }
        }, $types);

        // Obter o tipo do usuário
        $userType = $user->profile_type;
        
        // Se não for enum, converter do atributo bruto
        if (!($userType instanceof ProfileType)) {
            // Tentar obter do atributo cast
            $rawType = $user->getAttributes()['profile_type'] ?? $user->getOriginal('profile_type');
            
            // Se ainda for null, usar o valor padrão
            if (empty($rawType)) {
                $rawType = 'volunteer';
                // Atualizar o usuário com o valor padrão
                $user->profile_type = ProfileType::VOLUNTEER;
                $user->save();
            }
            
            try {
                $userType = ProfileType::from($rawType);
            } catch (\ValueError $e) {
                // Se falhar, usar volunteer como padrão
                $userType = ProfileType::VOLUNTEER;
                $user->profile_type = $userType;
                $user->save();
            }
        }

        // Verificar se o tipo do usuário está nos tipos permitidos
        $isAllowed = false;
        foreach ($allowedTypes as $allowedType) {
            if ($userType === $allowedType) {
                $isAllowed = true;
                break;
            }
        }

        if (!$isAllowed) {
            \Log::error('EnsureProfileType: Acesso negado', [
                'user_id' => $user->id,
                'user_type' => $userType->value ?? 'null',
                'allowed_types' => array_map(fn($t) => $t->value, $allowedTypes),
                'route' => $request->path()
            ]);
            abort(403, "Acesso negado. Seu perfil é: {$userType->label()}. Perfis permitidos: " . 
                  implode(', ', array_map(fn($t) => $t->label(), $allowedTypes)));
        }

        return $next($request);
    }
}
