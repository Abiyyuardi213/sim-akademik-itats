<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminKaprodiController extends Controller
{
    /**
     * Display a listing of Kaprodi users.
     */
    public function index()
    {
        // Filter users that have role containing 'Kaprodi' or 'Kepala Program Studi'
        // Or specific logic based on exact names.
        // It's safer to use the relationship.
        $users = User::whereHas('role', function ($query) {
            $query->where('role_name', 'like', '%Kaprodi%')
                ->orWhere('role_name', 'like', '%Kepala Program Studi%');
        })
            ->orderBy('created_at', 'desc')
            ->with(['role', 'prodi'])
            ->get();

        return view('admin.kaprodi.index', compact('users'));
    }

    /**
     * Show the form for creating a new Kaprodi.
     */
    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.kaprodi.create', compact('prodis'));
    }

    /**
     * Store a newly created Kaprodi in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'prodi_id' => 'required|exists:prodi,id',
            'nip' => 'required|string|max:50',
            'no_telepon' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Find or create Kaprodi Role
        // Assuming we want to assign one of the existing roles.
        // Let's try to find "Kaprodi" role first.
        $role = Role::where('role_name', 'Kaprodi')->first();
        if (!$role) {
            // Fallback or create? Better to fail or default.
            // Let's assume there is a 'Kaprodi' role
            $role = Role::firstOrCreate(['role_name' => 'Kaprodi']);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = $role->id;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $data['profile_picture'] = $filename;
        }

        User::createPengguna($data);

        return redirect()->route('admin.kaprodi.index')->with('success', 'Kaprodi berhasil ditambahkan');
    }

    /**
     * Display the specified Kaprodi.
     */
    public function show($id)
    {
        $user = User::with(['role', 'prodi'])->findOrFail($id);
        return view('admin.kaprodi.show', compact('user'));
    }

    /**
     * Show the form for editing the specified Kaprodi.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $prodis = Prodi::all();
        return view('admin.kaprodi.edit', compact('user', 'prodis'));
    }

    /**
     * Update the specified Kaprodi in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6', // Optional update
            'prodi_id' => 'required|exists:prodi,id',
            'nip' => 'required|string|max:50',
            'no_telepon' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'name',
            'username',
            'email',
            'prodi_id',
            'nip',
            'no_telepon'
        ]);

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $data['profile_picture'] = $filename;
        }

        // Ensure role stays Kaprodi (or update if needed, but this controller assumes Kaprodi)
        // We don't change role here.

        $user->updatePengguna($data);

        return redirect()->route('admin.kaprodi.index')->with('success', 'Data Kaprodi berhasil diperbarui');
    }

    /**
     * Remove the specified Kaprodi from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deletePengguna();

        return redirect()->route('admin.kaprodi.index')->with('success', 'Kaprodi berhasil dihapus');
    }
}
