<?php

namespace App\Http\Controllers;

use App\Models\PeriodeCuti;
use Illuminate\Http\Request;

class PeriodeCutiController extends Controller
{
    public function index()
    {
        $periodes = PeriodeCuti::orderBy('created_at', 'asc')->get();
        return view('periode.index', compact('periodes'));
    }

    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'awal_cuti' => 'required|string|max:255',
            'akhir_cuti' => 'required|string|max:255',
            'bulan_her' => 'required|string|max:255',
            'periode_status' => 'required|boolean',
        ]);

        PeriodeCuti::createPeriode($request->all());

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function show($id)
    {
        $periode = PeriodeCuti::findOrFail($id);
        return view('periode.show', compact('periode'));
    }

    public function edit($id)
    {
        $periode = PeriodeCuti::findOrFail($id);
        return view('periode.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'awal_cuti' => 'required|string|max:255',
            'akhir_cuti' => 'required|string|max:255',
            'bulan_her' => 'required|string|max:255',
            'periode_status' => 'required|boolean',
        ]);

        $periode = PeriodeCuti::findOrFail($id);
        $periode->updatePeriode($request->all());

        return redirect()->route('periode.index')->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $periode = PeriodeCuti::findOrFail($id);
        $periode->deletePeriode();

        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $periode = PeriodeCuti::findOrFail($id);
            $periode->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status periode berhasil diperbarui.'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
        // $periode = PeriodeCuti::findOrFail($id);
        // $periode->toggleStatus();

        // return redirect()->route('periode.index')->with('success', 'Status periode diperbarui.');
    }
}
