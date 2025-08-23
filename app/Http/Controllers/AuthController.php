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

        if (!$user || !in_array($user->role?->role_name, ['admin', 'CSR'])) {
            return back()->with('error', 'Username tidak ditemukan atau bukan admin dan csr.')->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')->withInput($request->only('username'));
        }

        Auth::guard('admin')->login($user);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
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

        Auth::guard('users')->login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('users.dashboard'));
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

        return redirect()->route('home');
    }
}
