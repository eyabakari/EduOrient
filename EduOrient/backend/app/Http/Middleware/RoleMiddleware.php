<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return response()->json([
                'message' => __('Non authentifié.'),
            ], 401);
        }

        $user = $request->user();

        if (! $user->role) {
            return response()->json([
                'message' => __('Aucun rôle associé à ce compte.'),
            ], 403);
        }

        if (! in_array($user->role, $roles, true)) {
            return response()->json([
                'message' => __('Accès refusé : rôle non autorisé pour cette ressource.'),
            ], 403);
        }

        return $next($request);
    }
}

