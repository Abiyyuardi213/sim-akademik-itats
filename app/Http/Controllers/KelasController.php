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

        $kelass = $query->orderBy('created_at', 'asc')->get();
        $gedungs = Gedung::all();

        return view('admin.kelas.index', compact('kelass', 'gedungs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.kelas.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_kelas' => 'required|string|max:255',
            'kapasitas_mahasiswa' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kelas_status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kelas'), $filename);
            $data['gambar'] = $filename;
        }

        Kelas::createKelas($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan')->with('new_entry_created', true);
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $gedungs = Gedung::all();
        return view('admin.kelas.edit', compact('kelas', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_kelas' => 'required|string|max:255',
            'kapasitas_mahasiswa' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kelas_status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kelas'), $filename);
            $data['gambar'] = $filename;
        }

        $kelas->updateKelas($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function show($id)
    {
        $kelas = Kelas::with('gedung')->findOrFail($id);
        return view('admin.kelas.show', compact('kelas'));
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            // Cast to boolean explicitly since AJAX sends 0 or 1 as integer/string
            $status = filter_var($request->input('kelas_status'), FILTER_VALIDATE_BOOLEAN);

            $kelas->kelas_status = $status;
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
