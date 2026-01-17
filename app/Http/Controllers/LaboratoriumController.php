<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Laboratorium;
use Illuminate\Http\Request;

class LaboratoriumController extends Controller
{
    public function index(Request $request)
    {
        $query = Laboratorium::with('gedung');

        if ($request->filled('gedung_id')) {
            $query->where('gedung_id', $request->gedung_id);
        }

        $laboratoriums = $query->orderBy('created_at', 'asc')->get();
        $gedungs = Gedung::all();

        return view('admin.laboratorium.index', compact('laboratoriums', 'gedungs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.laboratorium.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_laboratorium' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/laboratorium'), $filename);
            $data['gambar'] = $filename;
        }

        Laboratorium::createLaboratorium($data);

        return redirect()->route('admin.laboratorium.index')
            ->with('success', 'Laboratorium berhasil ditambahkan')
            ->with('new_entry_created', true);
    }

    public function edit($id)
    {
        $laboratorium = Laboratorium::findOrFail($id);
        $gedungs = Gedung::all();
        return view('admin.laboratorium.edit', compact('laboratorium', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $laboratorium = Laboratorium::findOrFail($id);

        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_laboratorium' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/laboratorium'), $filename);
            $data['gambar'] = $filename;
        }

        $laboratorium->updateLaboratorium($data);

        return redirect()->route('admin.laboratorium.index')
            ->with('success', 'Data laboratorium berhasil diperbarui.');
    }

    public function show($id)
    {
        $laboratorium = Laboratorium::with('gedung')->findOrFail($id);
        return view('admin.laboratorium.show', compact('laboratorium'));
    }

    public function destroy($id)
    {
        $laboratorium = Laboratorium::findOrFail($id);
        $laboratorium->deleteLaboratorium();

        return redirect()->route('admin.laboratorium.index')
            ->with('success', 'Laboratorium berhasil dihapus');
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $laboratorium = Laboratorium::findOrFail($id);
            $status = filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN);
            $laboratorium->status = $status;
            $laboratorium->save();

            return response()->json([
                'success' => true,
                'message' => 'Status laboratorium berhasil diperbarui.'
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
