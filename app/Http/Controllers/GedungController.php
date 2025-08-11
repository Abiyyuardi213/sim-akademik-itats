<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::orderBy('created_at', 'asc')->get();
        return view('admin.gedung.index', compact('gedungs'));
    }

    public function create()
    {
        return view('admin.gedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'gedung_description' => 'nullable|string',
            'gedung_status' => 'required|boolean',
        ]);

        Gedung::createGedung($request->all());

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil ditambahkan');
    }

    public function edit($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('admin.gedung.edit', compact('gedung'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'gedung_description' => 'nullable|string',
            'gedung_status' => 'required|boolean',
        ]);

        $gedung = Gedung::findOrFail($id);
        $gedung->updateGedung($request->all());

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil diupdate');
    }

    public function destroy($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->deleteGedung();

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $gedung = Gedung::findOrFail($id);
            $gedung->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status gedung berhasil diperbarui.'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
