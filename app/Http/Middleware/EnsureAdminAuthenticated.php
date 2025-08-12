<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login')->with('error', 'Harus login sebagai admin.');
        }

        $user = Auth::guard('admin')->user();

        if (!empty($roles)) {
            $userRoleName = strtolower($user->role?->role_name ?? '');

            $allowed = array_map('strtolower', $roles);

            if (!in_array($userRoleName, $allowed)) {
                abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
            }
        }

        return $next($request);
    }
}
