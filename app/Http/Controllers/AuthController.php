<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function showLoginGuestForm()
    {
        if (Auth::guard('users')->check()) {
            return redirect()->route('users.dashboard');
        }
        return view('auth.login-guest');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->with('role')->first();

        if (!$user || !in_array($user->role?->role_name, ['admin', 'CSR', 'Kaprodi', 'Kepala Program Studi'])) {
            return back()->with('error', 'Username tidak ditemukan atau bukan admin, CSR, atau Kaprodi.')->withInput($request->only('username'));
        }

        // Check password (support both Bcrypt hash and specific plain text fallback)
        $passwordValid = false;

        try {
            if (Hash::check($request->password, $user->password)) {
                $passwordValid = true;
            }
        } catch (\Exception $e) {
            // Ignore bcrypt errors to check plain text next
        }

        // If Hash check failed, check plain text
        if (!$passwordValid && $request->password === $user->password) {
            $passwordValid = true;
            // Auto-hash for future security
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if (!$passwordValid) {
            return back()->with('error', 'Password salah.')->withInput($request->only('username'));
        }

        $remember = $request->has('remember');

        Auth::guard('admin')->login($user, $remember);

        $request->session()->regenerate();

        // Redirect based on role
        $roleName = strtolower($user->role->role_name);
        if ($roleName === 'kaprodi' || $roleName === 'kepala program studi') {
            return redirect()->route('kaprodi.approval.index')->with('success', 'Login Berhasil sebagai Kaprodi.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil.');
    }

    public function guestLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
            ->with('role')
            ->first();

        if (!$user || strtolower($user->role?->role_name) !== 'guest') {
            return back()->with('error', 'Username tidak ditemukan atau bukan Guest.')
                ->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')
                ->withInput($request->only('username'));
        }

        $remember = $request->has('remember');

        Auth::guard('users')->login($user, $remember);

        $request->session()->regenerate();

        return redirect()->intended(route('users.dashboard'))->with('success', 'Login Berhasil.');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('users')->check()) {
            Auth::guard('users')->logout();
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
    }
}
