<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\PengajuanPeminjamanLaboratorium;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengajuanLaboratoriumController extends Controller
{
    public function index(Request $request)
    {
        $gedungs = \App\Models\Gedung::with(['laboratorium' => function ($query) {
            $query->where('status', 1)->orderBy('nama_laboratorium', 'asc');
        }])
            ->where('gedung_status', 1)
            ->whereHas('laboratorium', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('nama_gedung', 'asc')
            ->get();

        return view('user.pengajuan.laboratorium.index', compact('gedungs'));
    }

    public function create(Laboratorium $laboratorium)
    {
        $prodis = Prodi::all();

        $bookings = PengajuanPeminjamanLaboratorium::where('laboratorium_id', $laboratorium->id)
            ->whereIn('status', ['pending', 'disetujui', 'pending_kaprodi', 'pending_admin'])
            ->get([
                'tanggal_peminjaman',
                'tanggal_berakhir_peminjaman',
                'waktu_peminjaman',
                'waktu_berakhir_peminjaman',
                'status'
            ]);

        if (!$laboratorium->status) {
            return redirect()->route('users.pengajuan.laboratorium.index')
                ->with('error', 'Laboratorium tidak tersedia untuk diajukan.');
        }

        return view('user.pengajuan.laboratorium.create', compact('laboratorium', 'prodis', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laboratorium_id' => 'required|exists:laboratorium,id',
            'prodi_id' => 'required|exists:prodi,id',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_berakhir_peminjaman' => 'nullable|date|after_or_equal:tanggal_peminjaman',
            'waktu_peminjaman' => 'required|date_format:H:i',
            'waktu_berakhir_peminjaman' => 'required|date_format:H:i|after:waktu_peminjaman',
            'keperluan_peminjaman' => 'required|string',
        ]);

        $startDate = $request->tanggal_peminjaman;
        $endDate   = $request->tanggal_berakhir_peminjaman ?: $startDate;

        $startTime = $request->waktu_peminjaman;
        $endTime   = $request->waktu_berakhir_peminjaman;

        $exists = PengajuanPeminjamanLaboratorium::where('laboratorium_id', $request->laboratorium_id)
            ->whereIn('status', ['pending', 'disetujui', 'pending_kaprodi', 'pending_admin'])
            ->whereDate('tanggal_peminjaman', '<=', $endDate)
            ->whereDate('tanggal_berakhir_peminjaman', '>=', $startDate)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereTime('waktu_peminjaman', '<', $endTime)
                    ->whereTime('waktu_berakhir_peminjaman', '>', $startTime);
            })
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['waktu' => 'Laboratorium sudah dipakai pada rentang tanggal/waktu tersebut.'])
                ->withInput();
        }

        PengajuanPeminjamanLaboratorium::create([
            'id' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'laboratorium_id' => $request->laboratorium_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_peminjaman' => $startDate,
            'tanggal_berakhir_peminjaman' => $endDate,
            'waktu_peminjaman' => $startTime,
            'waktu_berakhir_peminjaman' => $endTime,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'status' => 'pending_kaprodi',
            'catatan_admin' => null,
            'catatan_kaprodi' => null,
        ]);

        return redirect()->route('users.pengajuan.laboratorium.index')->with('success', 'Pengajuan peminjaman laboratorium berhasil diajukan.');
    }
}
