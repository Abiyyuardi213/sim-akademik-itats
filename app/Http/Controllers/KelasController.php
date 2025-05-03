<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelass = Kelas::orderBy('created_at', 'asc')->get();
        return view('kelas.index', compact('kelass'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('kelas.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_kelas' => 'required|string|max:255',
            'kapasitas_mahasiswa' => 'required|integer',
            'keterangan' => 'nullable|string',
            'kelas_status' => 'required|boolean',
        ]);

        $data = $request->all();
        Kelas::createKelas($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelass = Kelas::findOrFail($id);
        $gedungs = Gedung::all();
        return view('kelas.edit', compact('kelas', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_kelas' => 'required|string|max:255',
            'kapasitas_mahasiswa' => 'required|integer',
            'keterangan' => 'nullable|string',
            'kelas_status' => 'required|boolean',
        ]);

        $data = $request->all();

        $kelas->updateKelas($data);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function show($id)
    {
        $kelas = Kelas::with('gedung')->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->deleteKelas();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
