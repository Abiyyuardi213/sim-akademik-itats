<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::orderBy('created_at', 'asc')->get();
        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'nullable|string|max:50',
            'prodi_description' => 'nullable|string',
            'prodi_status' => 'required|boolean',
        ]);

        Prodi::createProdi($request->all());

        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'nullable|string|max:50',
            'prodi_description' => 'nullable|string',
            'prodi_status' => 'required|boolean',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->updateProdi($request->all());

        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->deleteProdi();

        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $prodi = Prodi::findOrFail($id);
            $prodi->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status prodi berhasil diperbarui.'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
