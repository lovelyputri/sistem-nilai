<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        if (! $request->user()){
            return redirect()->route('login');
        }

        if (! in_array($request->user()->role, $role)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        //blokir guru yang belum dikonfirmasi oleh admin
        if ($request->user()->isGuru() && ! $request->isAktif()){
            abort(403, 'Akun Anda belum dikonfirmasi oleh admin.');
        }
        return $next($request);
    }
}
