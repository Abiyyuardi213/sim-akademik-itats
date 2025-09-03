<?php

namespace App\Http\Controllers;

use App\Models\FasilitasSupport;
use App\Models\Gedung;
use Illuminate\Http\Request;

class FasilitasSupportController extends Controller
{
    public function index(Request $request)
    {
        $query = FasilitasSupport::with('gedung');

        if ($request->filled('gedung_id')) {
            $query->where('gedung_id', $request->gedung_id);
        }

        $fasilitass = $query->orderBy('created_at', 'asc')->get();
        $gedungs = Gedung::all();

        return view('admin.fasilitas-support.index', compact('fasilitass', 'gedungs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.fasilitas-support.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_fasilitas' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'fasilitas_status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/fasilitas'), $filename);
            $data['gambar'] = $filename;
        }

        FasilitasSupport::createFasilitas($data);

        return redirect()->route('admin.fasilitas-support.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $fasilitas = FasilitasSupport::findOrFail($id);
        $gedungs = Gedung::all();
        return view('admin.fasilitas-support.edit', compact('fasilitas', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasSupport::findOrFail($id);

        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_fasilitas' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'fasilitas_status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/fasilitas'), $filename);
            $data['gambar'] = $filename;
        }

        $fasilitas->updateFasilitas($data);

        return redirect()->route('admin.fasilitas-support.index')->with('success', 'Data fasilitas berhasil diperbarui.');
    }

    public function show($id)
    {
        $fasilitas = FasilitasSupport::with('gedung')->findOrFail($id);
        return view('admin.fasilitas-support.show', compact('fasilitas'));
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $fasilitas = FasilitasSupport::findOrFail($id);

            $fasilitas->fasilitas_status = $request->input('fasilitas_status', !$fasilitas->fasilitas_status);
            $fasilitas->save();

            return response()->json([
                'success' => true,
                'message' => 'Status fasilitas berhasil diperbarui.'
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
