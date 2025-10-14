<?php

namespace App\Http\Controllers;

use App\Models\FasilitasSupport;
use App\Models\PengajuanPeminjamanSupport;
use App\Models\Prodi;
use App\Notifications\StatusPengajuanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PeminjamanSupportController extends Controller
{
    public function index()
    {
        $support = FasilitasSupport::with('gedung')
            ->orderBy('nama_fasilitas', 'asc')
            ->get();

        return view('user.pengajuan-support.index', compact('support'));
    }

    public function create(FasilitasSupport $support)
    {
        $prodis = Prodi::all();

        $bookings = PengajuanPeminjamanSupport::where('support_id', $support->id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->get([
                'tanggal_peminjaman',
                'tanggal_berakhir_peminjaman',
                'waktu_peminjaman',
                'waktu_berakhir_peminjaman',
                'status'
            ]);

        if (!$support->fasilitas_status) {
            return redirect()->route('users.pengajuan-support.index')
                ->with('error', 'Ruangan tidak tersedia untuk diajukan.');
        }

        return view('user.pengajuan-support.create', compact('support', 'prodis', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'support_id' => 'required|exists:fasilitas_support,id',
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

        $exists = PengajuanPeminjamanSupport::where('support_id', $request->support_id)
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

        PengajuanPeminjamanSupport::create([
            'id' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'support_id' => $request->support_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_peminjaman' => $startDate,
            'tanggal_berakhir_peminjaman' => $endDate,
            'waktu_peminjaman' => $startTime,
            'waktu_berakhir_peminjaman' => $endTime,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'status' => 'pending',
        ]);

        return redirect()->route('users.pengajuan-support.index')->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    }

    public function show($id)
    {
        $pengajuan = PengajuanPeminjamanSupport::with(['support', 'prodi'])
            ->where('user_id', Auth::guard('users')->id())
            ->findOrFail($id);

        return view('user.pengajuan-support.show', compact('pengajuan'));
    }

    public function riwayat()
    {
        $riwayats = PengajuanPeminjamanSupport::with(['support', 'prodi'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pengajuan-support.riwayat', compact('riwayats'));
    }

    public function rekap()
    {
        $rekap = PengajuanPeminjamanSupport::where('user_id', Auth::id())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('user.pengajuan-support.rekap', compact('rekap'));
    }

    public function status()
    {
        $statuses = PengajuanPeminjamanSupport::with('support')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($statuses);

        return view('user.pengajuan-support.status', compact('statuses'));
    }

    public function indexAdmin()
    {
        $pengajuans = PengajuanPeminjamanSupport::with(['support', 'prodi', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengajuan-support-admin.index', compact('pengajuans'));
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
        $pengajuan = PengajuanPeminjamanSupport::findOrFail($id);
        $pengajuan->status = 'disetujui';
        $pengajuan->catatan_admin = request('catatan_admin');
        $pengajuan->save();

        $pengajuan->user->notify(new StatusPengajuanNotification($pengajuan->status));

        return redirect()->route('admin.pengajuan-support-admin.index')
            ->with('success', 'Pengajuan berhasil disetujui');
    }

    public function reject($id)
    {
        $pengajuan = PengajuanPeminjamanSupport::findOrFail($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->catatan_admin = request('catatan_admin');
        $pengajuan->save();

        $pengajuan->user->notify(new StatusPengajuanNotification($pengajuan->status));

        return redirect()->route('admin.pengajuan-support-admin.index')
            ->with('success', 'Pengajuan berhasil ditolak');
    }

    public function showAdmin($id)
    {
        $pengajuan = PengajuanPeminjamanSupport::with(['kelas', 'prodi', 'user'])
            ->findOrFail($id);

        return view('admin.pengajuan-support-admin.show', compact('pengajuan'));
    }

    public function cetakPdf($id)
    {
        $pengajuan = PengajuanPeminjamanSupport::with(['kelas.gedung', 'prodi', 'user'])
            ->findOrFail($id);

        if ($pengajuan->status !== 'disetujui') {
            return redirect()->back()->with('error', 'PDF hanya bisa dibuat untuk pengajuan yang disetujui.');
        }

        Carbon::setLocale('id');

        $nama_kaprodi = $pengajuan->prodi->nama_kaprodi;
        $nip_kaprodi  = $pengajuan->prodi->nip_kaprodi;

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
            ->header('Content-Disposition', 'inline; filename="surat_peminjaman_'.$pengajuan->id.'.pdf"');
    }
}
