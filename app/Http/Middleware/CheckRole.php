<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // public function handle(Request $request, Closure $next, ...$roles): Response
    // {
    //     $user = Auth::user();

    //     if (
    //         !$user ||
    //         !$user->role ||
    //         !in_array(strtolower($user->role->role_name), array_map('strtolower', $roles))
    //     ) {
    //         abort(403, 'Akses ditolak.');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::guard()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($user->role !== $role) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
