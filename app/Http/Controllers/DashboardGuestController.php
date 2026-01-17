<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;

class DashboardGuestController extends Controller
{
    public function index()
    {
        $rekomendasi_ruangan = Kelas::with('gedung')
            ->where('kelas_status', 1)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $rekomendasi_ruangan_support = \App\Models\Support::with('gedung')
            ->where('ruangan_status', 1)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $userId = \Illuminate\Support\Facades\Auth::user()->id;

        $total_peminjaman = \App\Models\PengajuanPeminjamanRuangan::where('user_id', $userId)->count();
        $menunggu_persetujuan = \App\Models\PengajuanPeminjamanRuangan::where('user_id', $userId)
            ->whereIn('status', ['pending', 'pending_kaprodi', 'pending_admin'])
            ->count();
        $disetujui = \App\Models\PengajuanPeminjamanRuangan::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->count();

        return view('dashboard-user', compact('rekomendasi_ruangan', 'rekomendasi_ruangan_support', 'total_peminjaman', 'menunggu_persetujuan', 'disetujui'));
    }
}
