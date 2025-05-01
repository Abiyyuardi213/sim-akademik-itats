<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legalisir;

class LegalisirController extends Controller
{
    public function index()
    {
        $legalisirs = Legalisir::orderBy('created_at', 'asc')->get();
        return view('legalisir.index', compact('legalisirs'));
    }

    public function create()
    {
        return view('legalisir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_legalisir' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'jumlah_ijazah' => '',
            'jumlah_transkip' => '',
            'jumlah_lain' => '',
            'jumlah_total' => '',
        ]);

        Legalisir::createLegalisir($request->all());

        return redirect()->route('legalisir.index')->with('success', 'Data legalisir berhasil ditambahkan');
    }

    public function show($id)
    {
        $legalisir = Legalisir::findOrFail($id);
        return view('legalisir.show', compact('legalisir'));
    }

    public function edit($id)
    {
        $legalisir = Legalisir::findOrFail($id);
        return view('legalisir.edit', compact('legalisir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_legalisir' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'jumlah_ijazah' => '',
            'jumlah_transkip' => '',
            'jumlah_lain' => '',
            'jumlah_total' => '',
        ]);

        $legalisir = Legalisir::findOrFail($id);
        $legalisir->updateLegalisir($request->all());

        return redirect()->route('legalisir.index')->with('success', 'Data legalisir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $legalisir = Legalisir::findOrFail($id);
        $legalisir->deleteLegalisir();

        return redirect()->route('legalisir.index')->with('success', 'Data legalisir berhasil dihapus');
    }
}
