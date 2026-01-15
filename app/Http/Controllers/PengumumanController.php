<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        // Fetch announcements sorted by creation date descending
        $pengumumans = Pengumuman::with('author')->orderBy('tanggal_dibuat', 'desc')->get();
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $data = $request->all();
        // Ensure we are getting the ID of the currently logged-in admin
        $user = Auth::guard('admin')->user() ?? Auth::user();
        if (!$user) {
            return redirect()->back()->withErrors(['msg' => 'User not authenticated']);
        }
        $data['author_id'] = $user->id;
        $data['tanggal_dibuat'] = now();
        $data['tanggal_diperbarui'] = now();

        Pengumuman::createPengumuman($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::with('author')->findOrFail($id);
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $data = $request->all();
        $data['tanggal_diperbarui'] = now();

        $pengumuman->updatePengumuman($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->deletePengumuman();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
