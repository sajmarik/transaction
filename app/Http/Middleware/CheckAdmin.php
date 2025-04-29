<?php

// app/Http/Middleware/CheckAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Accès refusé. Vous n\'êtes pas autorisé.'], 403);
        }

        return $next($request);
    }
}
