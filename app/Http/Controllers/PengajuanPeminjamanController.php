<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PengajuanPeminjamanRuangan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengajuanPeminjamanController extends Controller
{
    // public function index()
    // {
    //     $pengajuans = PengajuanPeminjamanRuangan::with(['kelas', 'prodi'])
    //         ->where('user_id', Auth::id())
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return view('user.pengajuan.index', compact('pengajuans'));
    // }

    public function index()
    {
        $kelas = Kelas::with('gedung')
            ->orderBy('nama_kelas', 'asc')
            ->get();

        return view('user.pengajuan.index', compact('kelas'));
    }

    // public function create()
    // {
    //     $kelass = Kelas::all();
    //     $prodis = Prodi::all();
    //     return view('user.pengajuan.create', compact('kelass', 'prodis'));
    // }

    public function create(Kelas $kelas)
    {
        $prodis = Prodi::all();

        // Ambil semua rentang tanggal yang sudah dipesan utk kelas ini
        $bookings = PengajuanPeminjamanRuangan::where('kelas_id', $kelas->id)
            ->whereIn('status', ['approved', 'pending'])
            ->get(['tanggal_peminjaman', 'tanggal_berakhir_peminjaman']);

        // (opsional) blok akses jika kelas non-aktif
        if (!$kelas->kelas_status) {
            return redirect()->route('users.pengajuan.index')
                ->with('error', 'Ruangan tidak tersedia untuk diajukan.');
        }

        return view('user.pengajuan.create', compact('kelas', 'prodis', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'prodi_id' => 'required|exists:prodi,id',
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'tanggal_berakhir_peminjaman' => 'nullable|date|after_or_equal:tanggal_peminjaman',
            'waktu_peminjaman' => 'required|date_format:H:i',
            'waktu_berakhir_peminjaman' => 'required|date_format:H:i|after:waktu_peminjaman',
            'keperluan_peminjaman' => 'required|string',
        ]);

        PengajuanPeminjamanRuangan::create([
            'id' => Str::uuid(),
            'user_id' => Auth::id(),
            'kelas_id' => $request->kelas_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_berakhir_peminjaman' => $request->tanggal_berakhir_peminjaman,
            'waktu_peminjaman' => $request->waktu_peminjaman,
            'waktu_berakhir_peminjaman' => $request->waktu_berakhir_peminjaman,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'status' => 'pending',
        ]);

        return redirect()->route('user.pengajuan.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function show($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.pengajuan.show', compact('pengajuan'));
    }
}
