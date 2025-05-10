<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kelas::with('gedung');

        if ($request->filled('gedung_id')) {
            $query->where('gedung_id', $request->gedung_id);
        }

        $kelass = $query->orderBy('created_at', 'asc')->get(); // atau 'desc' untuk terbaru di atas
        $gedungs = Gedung::all();

        return view('kelas.index', compact('kelass', 'gedungs'));
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
        $kelas = Kelas::findOrFail($id);
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

    public function toggleStatus(Request $request, $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            $kelas->kelas_status = $request->input('kelas_status', !$kelas->kelas_status);
            $kelas->save();

            return response()->json([
                'success' => true,
                'message' => 'Status kelas berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
