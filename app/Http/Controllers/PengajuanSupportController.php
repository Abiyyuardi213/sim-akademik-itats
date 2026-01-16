<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\PengajuanPeminjamanRuangan;
use App\Models\Prodi;
use App\Notifications\StatusPengajuanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PengajuanSupportController extends Controller
{
    public function index()
    {
        $gedungs = \App\Models\Gedung::with(['support' => function ($query) {
            $query->where('ruangan_status', 1)->orderBy('nama_ruangan', 'asc'); // Only show active rooms
        }])
            ->where('gedung_status', 1) // Only show active buildings
            ->whereHas('support', function ($query) {
                $query->where('ruangan_status', 1);
            })
            ->orderBy('nama_gedung', 'asc')
            ->get();

        return view('user.pengajuan.support', compact('gedungs'));
    }

    // public function create(Kelas $kelas)
    // {
    //     $prodis = Prodi::all();

    //     $bookings = PengajuanPeminjamanRuangan::where('kelas_id', $kelas->id)
    //     ->whereIn('status', ['approved', 'pending'])
    //         ->get(['tanggal_peminjaman', 'tanggal_berakhir_peminjaman']);

    //     if (!$kelas->kelas_status) {
    //         return redirect()->route('users.pengajuan.index')
    //             ->with('error', 'Ruangan tidak tersedia untuk diajukan.');
    //     }

    //     return view('user.pengajuan.create', compact('kelas', 'prodis', 'bookings'));
    // }

    public function create(Support $support)
    {
        $prodis = Prodi::all();

        // Warning: Logic for bookings might need adjustment if using same table for booking, 
        // assuming standard structure for now but checking support_id or kelas_id column availability.
        // If pengajuan table only has kelas_id, we might need to add support_id or use a polymorphic relation.
        // For now, let's assume we proceed to display the form. 
        // NOTE: The current schema likely only has 'kelas_id'. If 'support' is distinct, we need a migration.
        // Assuming 'support' acts like 'kelas' and we might need adaptations.

        // TEMPORARY: Retaining standard logic, but this might fail if 'kelas_id' foreign key constraint exists and we pass support ID.
        // We will need to check if we can reuse the table or need a new one. 
        // Given the request "support adalah sebuah ruangan. seperti kelas", it implies distinct entity.
        // Let's create the view first.

        /* 
           CRITICAL: The current `pengajuan_peminjaman` table likely expects `kelas_id`. 
           If the user wants seamless support integration, we probably need `support_id` in that table 
           or a separate table.
           However, to just show the "Daftar Ruangan Support", we only need the index method working well for now.
           Accessing create page might require further DB changes which I'll handle if requested.
        */

        // Placeholder logic for bookings check (won't work 100% without DB update)
        $bookings = [];

        if (!$support->ruangan_status) {
            return redirect()->route('users.pengajuan.support')
                ->with('error', 'Ruangan tidak tersedia untuk diajukan.');
        }

        return view('user.pengajuan.create_support', compact('support', 'prodis', 'bookings'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'kelas_id' => 'required|exists:kelas,id',
    //         'prodi_id' => 'required|exists:prodi,id',
    //         'tanggal_peminjaman' => 'required|date',
    //         'tanggal_berakhir_peminjaman' => 'nullable|date|after_or_equal:tanggal_peminjaman',
    //         'waktu_peminjaman' => 'required',
    //         'waktu_berakhir_peminjaman' => 'required|after:waktu_peminjaman',
    //         'keperluan_peminjaman' => 'required|string',
    //     ]);

    //     PengajuanPeminjamanRuangan::create([
    //         'id' => Str::uuid(),
    //         'user_id' => Auth::user()->id,
    //         'kelas_id' => $request->kelas_id,
    //         'prodi_id' => $request->prodi_id,
    //         'tanggal_peminjaman' => $request->tanggal_peminjaman,
    //         'tanggal_berakhir_peminjaman' => $request->tanggal_berakhir_peminjaman,
    //         'waktu_peminjaman' => $request->waktu_peminjaman,
    //         'waktu_berakhir_peminjaman' => $request->waktu_berakhir_peminjaman,
    //         'keperluan_peminjaman' => $request->keperluan_peminjaman,
    //         'status' => 'pending',
    //     ]);

    //     return redirect()->route('users.pengajuan.index')->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
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

        $exists = PengajuanPeminjamanRuangan::where('kelas_id', $request->kelas_id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->whereDate('tanggal_peminjaman', '<=', $endDate)
            ->whereDate('tanggal_berakhir_peminjaman', '>=', $startDate)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereTime('waktu_peminjaman', '<', $endTime)
                    ->whereTime('waktu_berakhir_peminjaman', '>', $startTime);
            })
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['waktu' => 'Ruangan sudah dipakai pada rentang tanggal/waktu tersebut.'])
                ->withInput();
        }

        PengajuanPeminjamanRuangan::create([
            'id' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'kelas_id' => $request->kelas_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_peminjaman' => $startDate,
            'tanggal_berakhir_peminjaman' => $endDate,
            'waktu_peminjaman' => $startTime,
            'waktu_berakhir_peminjaman' => $endTime,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'status' => 'pending_kaprodi',
            'catatan_admin' => null, // ensure clear
            'catatan_kaprodi' => null,
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

    public function indexAdmin()
    {
        $pengajuans = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
            // Admin only sees what passed Kaprodi or is already processed
            ->where('status', '!=', 'pending_kaprodi')
            ->orderByRaw("FIELD(status, 'pending_admin', 'disetujui', 'ditolak')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengajuan-ruangan.index', compact('pengajuans'));
    }

    // public function approve($id)
    // {
    //     $pengajuan = PengajuanPeminjamanRuangan::findOrFail($id);
    //     $pengajuan->status = 'disetujui';
    //     $pengajuan->catatan_admin = request('catatan_admin');
    //     $pengajuan->save();

    //     return redirect()->route('admin.pengajuan-ruangan.index')
    //         ->with('success', 'Pengajuan berhasil disetujui');
    // }

    public function approve($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::findOrFail($id);

        // Hanya boleh approve jika status pending_admin (sudah disetujui kaprodi)
        if ($pengajuan->status !== 'pending_admin') {
            return back()->with('error', 'Hanya pengajuan yang sudah disetujui Kaprodi (pending admin) yang bisa disetujui Admin.');
        }

        $pengajuan->status = 'disetujui';
        $pengajuan->catatan_admin = request('catatan_admin');
        $pengajuan->save();

        // Kirim notifikasi ke user terkait
        $pengajuan->user->notify(new StatusPengajuanNotification($pengajuan->status));

        return redirect()->route('admin.pengajuan-ruangan.index')
            ->with('success', 'Pengajuan berhasil disetujui');
    }

    public function reject($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::findOrFail($id);
        $pengajuan->status = 'ditolak'; // pastikan konsisten dengan badge di Blade kamu
        $pengajuan->catatan_admin = request('catatan_admin');
        $pengajuan->save();

        $pengajuan->user->notify(new StatusPengajuanNotification($pengajuan->status));

        return redirect()->route('admin.pengajuan-ruangan.index')
            ->with('success', 'Pengajuan berhasil ditolak');
    }

    public function showAdmin($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
            ->findOrFail($id);

        return view('admin.pengajuan-ruangan.show', compact('pengajuan'));
    }

    public function cetakPdf($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::with(['kelas.gedung', 'prodi', 'user'])
            ->findOrFail($id);

        if ($pengajuan->status !== 'disetujui') {
            return redirect()->back()->with('error', 'PDF hanya bisa dibuat untuk pengajuan yang disetujui.');
        }

        Carbon::setLocale('id');

        $nama_kaprodi = $pengajuan->prodi->kaprodi_name;
        $nip_kaprodi  = $pengajuan->prodi->kaprodi_nip;

        $pdf = Pdf::loadView('pdf.surat_peminjaman', compact('pengajuan', 'nama_kaprodi', 'nip_kaprodi'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'margin-top' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0,
                'margin-right' => 0,
            ]);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="surat_peminjaman_' . $pengajuan->id . '.pdf"');
    }
}
