<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user() ?? Auth::guard('admin')->user();

        // Pastikan user login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Harus login sebagai admin.');
        }

        // Pastikan role user adalah admin
        if (!$user->role || $user->role->role_name !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}
