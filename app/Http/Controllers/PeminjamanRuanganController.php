<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanRuangan;
use App\Models\Kelas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        $peminjamans = PeminjamanRuangan::orderBy('created_at', 'desc')->with('kelas')->with('prodi')->get();
        return view('admin.peminjaman-ruangan.index', compact('peminjamans'));
    }

    public function create()
    {
        $kelass = Kelas::orderBy('nama_kelas', 'asc')->get(); // urut berdasarkan nama
        $prodis = Prodi::orderBy('kode_prodi', 'asc')->get();
        return view('admin.peminjaman-ruangan.create', compact('kelass', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_peminjaman' => 'required|date',
            'tanggal_berakhir_peminjaman' => 'required|date',
            'waktu_peminjaman' => 'required|date_format:H:i',
            'waktu_berakhir_peminjaman' => 'required|date_format:H:i',
            'kelas_id' => 'required|exists:kelas,id',
            'prodi_id' => 'required|exists:prodi,id',
            'keperluan_peminjaman' => 'required|string|max:255',
        ]);

        $data = $request->all();

        PeminjamanRuangan::createPeminjamanRuangan($data);
        return redirect()->route('admin.peminjaman-ruangan.index')->with('success', 'Data peminjaman ruangan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peminjaman = PeminjamanRuangan::findOrFail($id);
        $kelass = Kelas::orderBy('nama_kelas', 'asc')->get(); // urut juga saat edit
        $prodis = Prodi::orderBy('kode_prodi', 'asc')->get();
        return view('admin.peminjaman-ruangan.edit', compact('peminjaman', 'kelass', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = PeminjamanRuangan::findOrFail($id);

        $request->validate([
            'tanggal_peminjaman' => 'required|date',
            'tanggal_berakhir_peminjaman' => 'required|date',
            'waktu_peminjaman' => 'required|date_format:H:i',
            'waktu_berakhir_peminjaman' => 'required|date_format:H:i|after:waktu_peminjaman',
            'kelas_id' => 'required|exists:kelas,id',
            'prodi_id' => 'required|exists:prodi,id',
            'keperluan_peminjaman' => 'required|string|max:255',
        ], [
            'waktu_berakhir_peminjaman.after' => 'Waktu berakhir peminjaman harus setelah waktu peminjaman.',
        ]);

        $peminjaman->update([
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_berakhir_peminjaman' => $request->tanggal_berakhir_peminjaman,
            'waktu_peminjaman' => $request->waktu_peminjaman,
            'waktu_berakhir_peminjaman' => $request->waktu_berakhir_peminjaman,
            'kelas_id' => $request->kelas_id,
            'prodi_id' => $request->prodi_id,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
        ]);

        return redirect()->route('admin.peminjaman-ruangan.index')
            ->with('success', 'Data peminjaman ruangan berhasil diupdate.');
    }

    public function show($id)
    {
        $peminjaman = PeminjamanRuangan::with(['kelas', 'prodi'])->findOrFail($id);
        return view('admin.peminjaman-ruangan.show', compact('peminjaman'));
    }

    public function destroy($id)
    {
        $peminjaman = PeminjamanRuangan::findOrFail($id);
        $peminjaman->deletePeminjamanRuangan();

        return redirect()->route('admin.peminjaman-ruangan.index')
            ->with('success', 'Data peminjaman ruangan berhasil dihapus');
    }
}
