<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanRuangan;
use App\Models\PengajuanPeminjamanRuangan;
use App\Models\Kelas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // Validasi Bentrok Jadwal
        $startDate = $request->tanggal_peminjaman;
        $endDate   = $request->tanggal_berakhir_peminjaman;
        $startTime = $request->waktu_peminjaman;
        $endTime   = $request->waktu_berakhir_peminjaman;

        // 1. Cek bentrok dengan sesama Manual Booking
        $conflictAdmin = PeminjamanRuangan::where('kelas_id', $request->kelas_id)
            ->whereDate('tanggal_peminjaman', '<=', $endDate)
            ->whereDate('tanggal_berakhir_peminjaman', '>=', $startDate)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereTime('waktu_peminjaman', '<', $endTime)
                    ->whereTime('waktu_berakhir_peminjaman', '>', $startTime);
            })
            ->exists();

        // 2. Cek bentrok dengan Pengajuan User yang SUDAH DISETUJUI
        $conflictUser = PengajuanPeminjamanRuangan::where('kelas_id', $request->kelas_id)
            ->where('status', 'disetujui')
            ->whereDate('tanggal_peminjaman', '<=', $endDate)
            ->whereDate('tanggal_berakhir_peminjaman', '>=', $startDate)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereTime('waktu_peminjaman', '<', $endTime)
                    ->whereTime('waktu_berakhir_peminjaman', '>', $startTime);
            })
            ->exists();

        if ($conflictAdmin || $conflictUser) {
            return back()
                ->withErrors(['conflict' => 'Jadwal bentrok! Ruangan sudah terisi pada waktu tersebut.'])
                ->withInput();
        }

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

    public function monitoring(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->start; // sent by FullCalendar
            $end = $request->end;     // sent by FullCalendar

            // 1. Ambil data PeminjamanRuangan (Manual Admin)
            $manualBookings = PeminjamanRuangan::with(['kelas', 'prodi'])
                ->where(function ($q) use ($start, $end) {
                    $q->whereBetween('tanggal_peminjaman', [$start, $end])
                        ->orWhereBetween('tanggal_berakhir_peminjaman', [$start, $end]);
                })
                ->get();

            // 2. Ambil data PengajuanPeminjamanRuangan (User Request - Status Disetujui)
            $userRequests = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
                ->where('status', 'disetujui')
                ->where(function ($q) use ($start, $end) {
                    $q->whereBetween('tanggal_peminjaman', [$start, $end])
                        ->orWhereBetween('tanggal_berakhir_peminjaman', [$start, $end]);
                })
                ->get();

            $events = [];

            // Mapping Manual Bookings
            foreach ($manualBookings as $booking) {
                $peminjamName = $booking->prodi->nama_prodi ?? 'Admin (Manual)';
                // Basic colors
                $bgColor = '#3b82f6';
                $borderColor = '#2563eb';

                // Optional: Customize color based on prodi or other logic if needed in future

                $events[] = [
                    'id' => 'manual-' . $booking->id,
                    'title' => $booking->kelas->nama_kelas . ' - ' . $peminjamName,
                    'start' => $booking->tanggal_peminjaman . 'T' . $booking->waktu_peminjaman,
                    'end' => $booking->tanggal_berakhir_peminjaman . 'T' . $booking->waktu_berakhir_peminjaman,
                    'backgroundColor' => $bgColor,
                    'borderColor' => $borderColor,
                    'extendedProps' => [
                        'peminjam' => $peminjamName,
                        'kegiatan' => $booking->keperluan_peminjaman,
                        'waktu' => Carbon::parse($booking->waktu_peminjaman)->format('H:i') . ' - ' . Carbon::parse($booking->waktu_berakhir_peminjaman)->format('H:i') . ' WIB',
                        'ruangan' => $booking->kelas->nama_kelas,
                        'tanggal' => Carbon::parse($booking->tanggal_peminjaman)->translatedFormat('d F Y'),
                    ]
                ];
            }

            // Mapping User Requests
            foreach ($userRequests as $request) {
                $peminjamName = $request->prodi->nama_prodi ?? $request->user->name ?? '-';

                $events[] = [
                    'id' => 'user-' . $request->id,
                    'title' => ($request->kelas->nama_kelas ?? '-') . ' - ' . $peminjamName,
                    'start' => $request->tanggal_peminjaman . 'T' . $request->waktu_peminjaman,
                    'end' => $request->tanggal_berakhir_peminjaman . 'T' . $request->waktu_berakhir_peminjaman,
                    'backgroundColor' => '#10b981', // emerald-500
                    'borderColor' => '#059669',
                    'extendedProps' => [
                        'peminjam' => $peminjamName,
                        'kegiatan' => $request->keperluan_peminjaman,
                        'waktu' => Carbon::parse($request->waktu_peminjaman)->format('H:i') . ' - ' . Carbon::parse($request->waktu_berakhir_peminjaman)->format('H:i') . ' WIB',
                        'ruangan' => $request->kelas->nama_kelas ?? '-',
                        'tanggal' => Carbon::parse($request->tanggal_peminjaman)->translatedFormat('d F Y'),
                    ]
                ];
            }

            return response()->json($events);
        }

        return view('admin.peminjaman-ruangan.monitoring');
    }
}
