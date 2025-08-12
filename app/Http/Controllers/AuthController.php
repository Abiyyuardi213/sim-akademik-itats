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

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    //         Log::info('Login berhasil untuk: ' . $request->username);
    //         $request->session()->regenerate();
    //         return redirect()->route('dashboard');
    //     }

    //     Log::warning('Login gagal untuk: ' . $request->username);
    //     throw ValidationException::withMessages([
    //         'username' => ['Username atau password salah.'],
    //     ]);
    // }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->with('role')->first();

        if (!$user || !in_array($user->role?->role_name, ['admin', 'csr'])) {
            return back()->with('error', 'Username tidak ditemukan atau bukan admin.')->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')->withInput($request->only('username'));
        }

        Auth::guard('admin')->login($user);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    // public function loginGuest(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    //         Log::info('Login berhasil untuk: ' . $request->username);
    //         $request->session()->regenerate();
    //         return redirect()->route('dashboard.user');
    //     }

    //     Log::warning('Login gagal untuk: ' . $request->username);
    //     throw ValidationException::withMessages([
    //         'username' => ['Username atau password salah.'],
    //     ]);
    // }

    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('users')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('users')->user();

            if (!$user->role || strtolower($user->role->role_name) !== 'guest') {
                Auth::guard('users')->logout();
                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki izin sebagai Guest.',
                ])->withInput();
            }

            return redirect()->intended(route('users.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();

    //         $roleName = $user->role?->role_name;

    //         Log::info("Login berhasil: {$user->username} sebagai {$roleName}");

    //         if ($roleName === 'guest') {
    //             return redirect()->route('dashboard.user');
    //         }

    //         return redirect()->route('dashboard');
    //     }

    //     Log::warning('Login gagal untuk: ' . $request->username);
    //     throw ValidationException::withMessages([
    //         'username' => ['Username atau password salah.'],
    //     ]);
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/login');
    // }

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

        return redirect()->route('login');
    }
}
