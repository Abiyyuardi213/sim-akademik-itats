<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::orderBy('create_at', 'asc')->get();
        return view('gedung.index', compact('gedungs'));
    }

    public function create()
    {
        return view('gedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'gedung_description' => 'nullable|string',
            'gedung_status' => 'required|boolean',
        ]);

        Gedung::createGedung($request->all());

        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil ditambahkan');
    }

    public function edit($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('gedung.edit', compact('gedung'));
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

        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil diupdate');
    }

    public function destroy($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->deleteGedung();

        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->toggleStatus();

        return redirect()->route('gedung.index')->with('success', 'Status gedung diperbarui.');
    }
}
