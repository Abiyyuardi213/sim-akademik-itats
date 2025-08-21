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
    public function index()
    {
        $kelas = Kelas::with('gedung')
            ->orderBy('nama_kelas', 'asc')
            ->get();

        return view('user.pengajuan.index', compact('kelas'));
    }

    public function create(Kelas $kelas)
    {
        $prodis = Prodi::all();

        $bookings = PengajuanPeminjamanRuangan::where('kelas_id', $kelas->id)
            ->whereIn('status', ['approved', 'pending'])
            ->get(['tanggal_peminjaman', 'tanggal_berakhir_peminjaman']);

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
            'tanggal_peminjaman' => 'required|date',
            'tanggal_berakhir_peminjaman' => 'nullable|date|after_or_equal:tanggal_peminjaman',
            'waktu_peminjaman' => 'required',
            'waktu_berakhir_peminjaman' => 'required|after:waktu_peminjaman',
            'keperluan_peminjaman' => 'required|string',
        ]);

        PengajuanPeminjamanRuangan::create([
            'id' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'kelas_id' => $request->kelas_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_berakhir_peminjaman' => $request->tanggal_berakhir_peminjaman,
            'waktu_peminjaman' => $request->waktu_peminjaman,
            'waktu_berakhir_peminjaman' => $request->waktu_berakhir_peminjaman,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'status' => 'pending',
        ]);

        return redirect()->route('users.pengajuan.index')->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    }

    public function show($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi'])
            ->where('user_id', Auth::guard('users')->id()) // ✅ pakai guard users
            ->findOrFail($id);

        return view('user.pengajuan.show', compact('pengajuan'));
    }

    public function riwayat()
    {
        $riwayats = PengajuanPeminjamanRuangan::with(['kelas', 'prodi'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pengajuan.riwayat', compact('riwayats'));
    }

    public function rekap()
    {
        $rekap = PengajuanPeminjamanRuangan::where('user_id', Auth::id())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('user.pengajuan.rekap', compact('rekap'));
    }

    public function status()
    {
        $statuses = PengajuanPeminjamanRuangan::with('kelas')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($statuses);

        return view('user.pengajuan.status', compact('statuses'));
    }
}
