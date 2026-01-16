<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $query = Support::with('gedung');

        if ($request->filled('gedung_id')) {
            $query->where('gedung_id', $request->gedung_id);
        }

        $supports = $query->orderBy('created_at', 'asc')->get();
        $gedungs = Gedung::all();

        return view('admin.support.index', compact('supports', 'gedungs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.support.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|string',
            'ruangan_status' => 'required|boolean',
        ]);

        Support::createSupport($request->all());

        return redirect()->route('admin.support.index')->with('success', 'Ruangan support berhasil ditambahkan')->with('new_entry_created', true);
    }

    public function edit($id)
    {
        $support = Support::findOrFail($id);
        $gedungs = Gedung::all();
        return view('admin.support.edit', compact('support', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $support = Support::findOrFail($id);

        $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|string',
            'ruangan_status' => 'required|boolean',
        ]);

        $support->updateSupport($request->all());

        return redirect()->route('admin.support.index')->with('success', 'Data ruangan support berhasil diperbarui.');
    }

    public function show($id)
    {
        $support = Support::with('gedung')->findOrFail($id);
        return view('admin.support.show', compact('support'));
    }

    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->deleteSupport();

        return redirect()->route('admin.support.index')->with('success', 'Ruangan support berhasil dihapus');
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $support = Support::findOrFail($id);

            // Cast to boolean explicitly since AJAX sends 0 or 1 as integer/string
            $status = filter_var($request->input('ruangan_status'), FILTER_VALIDATE_BOOLEAN);

            $support->ruangan_status = $status;
            $support->save();

            return response()->json([
                'success' => true,
                'message' => 'Status ruangan support berhasil diperbarui.'
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
