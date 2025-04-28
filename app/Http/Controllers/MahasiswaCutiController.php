<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaCuti;
use App\Models\PeriodeCuti;
use App\Models\Prodi;

class MahasiswaCutiController extends Controller
{
    public function index()
    {
        $mahasiswas = MahasiswaCuti::orderBy('created_at', 'asc')->with('prodi')->get();
        return view('mahasiswa-cuti.mahasiswaList', compact('mahasiswas'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $periodes = PeriodeCuti::all();
        return view('mahasiswa-cuti.create', compact('prodis', 'periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:mahasiswa_cuti,npm',
            'prodi_id' => 'required|exists:prodi,id',
            'periode_id' => 'required|exists:periode_cuti,id',
            'nomor_cuti' => 'required|string|max:255|unique:mahasiswa_cuti,nomor_cuti',
            'keterangan' => 'nullable|string|max:255',
            'surat_status' => 'required|boolean',
        ]);

        $data = $request->all();

        MahasiswaCuti::createMahasiswaCuti($data);

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data mahasiswa cuti berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswa = MahasiswaCuti::findOrFail($id);
        $prodis = Prodi::all();
        $periodes = PeriodeCuti::all();
        return view('mahasiswa-cuti.edit', compact('mahasiswa', 'prodis', 'periodes'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = MahasiswaCuti::findOrFail($id);

        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:mahasiswa_cuti,npm,' . $mahasiswa->id,
            'prodi_id' => 'required|exists:prodi,id',
            'periode_id' => 'required|exists:periode_cuti,id',
            'nomor_cuti' => 'required|string|max:255|unique:mahasiswa_cuti,nomor_cuti,' . $mahasiswa->id,
            'keterangan' => 'nullable|string|max:255',
            'surat_status' => 'required|boolean',
        ]);

        $data = $request->all();
        $mahasiswa->updateMahasiswaCuti($data);

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data mahasiswa cuti berhasil diubah');
    }

    public function show($id)
    {
        $mahasiswa = MahasiswaCuti::with(['prodi', 'periode'])->findOrFail($id);
        return view('mahasiswa-cuti.show', compact('mahasiswa'));
    }

    public function destroy($id)
    {
        $mahasiswa = MahasiswaCuti::findOrFail($id);
        $mahasiswa->deleteMahasiswaCuti();

        return redirect()->route('mahasiswa-cuti.index')->with('success', 'Data mahasiswa cuti berhasil di hapus');
    }
}
