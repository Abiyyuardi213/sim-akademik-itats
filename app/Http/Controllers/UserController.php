<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // Urutkan dari yang terlama (ASC) ke terbaru
        $users = User::orderBy('created_at', 'asc')->with('role')->get();
        return view('admin.user.userList', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $prodis = \App\Models\Prodi::all();
        return view('admin.user.create', compact('roles', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'nullable|email|max:255|unique:users,email',
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'role_id' => 'required|exists:role,id',
            'prodi_id' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    $role = Role::find($request->role_id);
                    return $role && (Str::contains(strtolower($role->role_name), 'kaprodi') || Str::contains(strtolower($role->role_name), 'kepala program studi'));
                }),
                'exists:prodi,id'
            ],
            'nip' => [
                'nullable',
                'string',
                'max:50',
                Rule::requiredIf(function () use ($request) {
                    $role = Role::find($request->role_id);
                    return $role && (Str::contains(strtolower($role->role_name), 'kaprodi') || Str::contains(strtolower($role->role_name), 'kepala program studi'));
                }),
            ],
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $data['profile_picture'] = $filename;
        }

        User::createPengguna($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan')->with('new_entry', true);
    }

    // ... (edit, update, show methods remain implicitly same, just skipping in this replacement block to save space if not modifying) ...

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deletePengguna();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus.'
            ]);
        }

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}
