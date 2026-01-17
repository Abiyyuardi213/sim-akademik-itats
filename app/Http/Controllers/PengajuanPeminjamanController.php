<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PengajuanPeminjamanRuangan;
use App\Models\PengajuanPeminjamanSupport;
use App\Models\PengajuanPeminjamanLaboratorium;
use App\Models\Prodi;
use App\Notifications\StatusPengajuanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PengajuanPeminjamanController extends Controller
{
    public function index()
    {
        $gedungs = \App\Models\Gedung::with(['kelas' => function ($query) {
            $query->where('kelas_status', 1)->orderBy('nama_kelas', 'asc'); // Only show active classes and order them
        }])
            ->where('gedung_status', 1) // Only show active buildings
            ->whereHas('kelas', function ($query) {
                $query->where('kelas_status', 1);
            })
            ->orderBy('nama_gedung', 'asc')
            ->get();

        return view('user.pengajuan.index', compact('gedungs'));
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

    public function create(Kelas $kelas)
    {
        $prodis = Prodi::all();

        $bookings = PengajuanPeminjamanRuangan::where('kelas_id', $kelas->id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->get([
                'tanggal_peminjaman',
                'tanggal_berakhir_peminjaman',
                'waktu_peminjaman',
                'waktu_berakhir_peminjaman',
                'status'
            ]);

        if (!$kelas->kelas_status) {
            return redirect()->route('users.pengajuan.index')
                ->with('error', 'Ruangan tidak tersedia untuk diajukan.');
        }

        return view('user.pengajuan.create', compact('kelas', 'prodis', 'bookings'));
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

        Auth::user()->notify(new \App\Notifications\PengajuanBerhasilDikirimNotification('Ruangan'));

        return redirect()->route('users.pengajuan.index')->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    }

    public function show($id)
    {
        $pengajuan = null;
        $type = 'ruangan';

        // Try Ruangan
        $pengajuan = PengajuanPeminjamanRuangan::with(['kelas.gedung', 'prodi'])
            ->where('id', $id)
            ->first();

        if (!$pengajuan) {
            // Try Support
            $pengajuan = PengajuanPeminjamanSupport::with(['support.gedung', 'prodi'])
                ->where('id', $id)
                ->first();
            if ($pengajuan) {
                $type = 'support';
                // normalize relationship for view
                $pengajuan->setRelation('kelas', $pengajuan->support);
                // We fake 'kelas' relation so view can use $pengajuan->kelas->nama_kelas (if mapped) 
                // OR we update view. Updating view is cleaner but complex. 
                // Let's modify the view to be smart or normalize here.
                // The view expects: $pengajuan->kelas->nama_kelas, $pengajuan->kelas->gedung->nama_gedung, $pengajuan->kelas->kapasitas_mahasiswa

                // Let's map support attributes to match what view expects or update view?
                // Updating view is safer. But let's verify if we can pass a generic structure.
            }
        }

        if (!$pengajuan) {
            // Try Lab
            $pengajuan = PengajuanPeminjamanLaboratorium::with(['laboratorium.gedung', 'prodi'])
                ->where('id', $id)
                ->first();
            if ($pengajuan) {
                $type = 'laboratorium';
            }
        }

        if (!$pengajuan) {
            abort(404);
        }

        if ($pengajuan->user_id != Auth::user()->id) {
            abort(404);
        }

        return view('user.pengajuan.show', compact('pengajuan', 'type'));
    }

    public function riwayat()
    {
        $ruangan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type = 'ruangan';
                $item->room_name = $item->kelas->nama_kelas ?? '-';
                $item->entity = $item->kelas;
                return $item;
            });

        $support = PengajuanPeminjamanSupport::with(['support', 'prodi'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type = 'support';
                $item->room_name = $item->support->nama_ruangan ?? '-';
                $item->entity = $item->support;
                return $item;
            });

        $lab = PengajuanPeminjamanLaboratorium::with(['laboratorium', 'prodi'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type = 'laboratorium';
                $item->room_name = $item->laboratorium->nama_laboratorium ?? '-';
                $item->entity = $item->laboratorium;
                return $item;
            });

        // Merge and Sort
        $riwayats = $ruangan->concat($support)->concat($lab)->sortByDesc('created_at');

        // Manual Pagination
        $perPage = 10;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
        $currentItems = $riwayats->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $riwayats = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, count($riwayats), $perPage, $currentPage, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
        ]);

        return view('user.pengajuan.riwayat', compact('riwayats'));
    }

    public function rekap()
    {
        // Must aggregate counts from all tables
        $ruangan = PengajuanPeminjamanRuangan::where('user_id', Auth::id())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        $support = PengajuanPeminjamanSupport::where('user_id', Auth::id())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        $lab = PengajuanPeminjamanLaboratorium::where('user_id', Auth::id())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        // Merge counts
        $rekap = [];
        $allStatuses = array_unique(array_merge(array_keys($ruangan), array_keys($support), array_keys($lab)));
        foreach ($allStatuses as $status) {
            $rekap[$status] = ($ruangan[$status] ?? 0) + ($support[$status] ?? 0) + ($lab[$status] ?? 0);
        }

        return view('user.pengajuan.rekap', compact('rekap'));
    }

    public function status()
    {
        $ruangan = PengajuanPeminjamanRuangan::with('kelas')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type = 'ruangan';
                $item->room_name = $item->kelas->nama_kelas ?? 'Ruangan';
                $item->entity = $item->kelas;
                return $item;
            });

        $support = PengajuanPeminjamanSupport::with('support')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type = 'support';
                $item->room_name = $item->support->nama_ruangan ?? 'Support';
                $item->entity = $item->support;
                return $item;
            });

        $lab = PengajuanPeminjamanLaboratorium::with('laboratorium')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type = 'laboratorium';
                $item->room_name = $item->laboratorium->nama_laboratorium ?? 'Lab';
                $item->entity = $item->laboratorium;
                return $item;
            });

        // Merge and sort
        $statuses = $ruangan->concat($support)->concat($lab)->sortByDesc('created_at');

        return view('user.pengajuan.status', compact('statuses'));
    }

    public function indexAdmin()
    {
        // 1. Fetch from PengajuanPeminjamanRuangan
        $ruangan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
            ->where('status', '!=', 'pending_kaprodi')
            ->get()
            ->map(function ($item) {
                $item->type = 'ruangan';
                $item->room_name = $item->kelas->nama_kelas ?? '-';
                return $item;
            });

        // 2. Fetch from PengajuanPeminjamanSupport
        $support = \App\Models\PengajuanPeminjamanSupport::with(['support', 'prodi', 'user'])
            ->where('status', '!=', 'pending_kaprodi')
            ->get()
            ->map(function ($item) {
                $item->type = 'support';
                $item->room_name = $item->support->nama_ruangan ?? '-';
                $item->setRelation('kelas', $item->support); // For view compatibility
                return $item;
            });

        // 3. Fetch from PengajuanPeminjamanLaboratorium
        $lab = \App\Models\PengajuanPeminjamanLaboratorium::with(['laboratorium', 'prodi', 'user'])
            ->where('status', '!=', 'pending_kaprodi')
            ->get()
            ->map(function ($item) {
                $item->type = 'laboratorium';
                $item->room_name = $item->laboratorium->nama_laboratorium ?? '-';
                $item->setRelation('kelas', $item->laboratorium); // For view compatibility
                return $item;
            });

        // 4. Merge all collections
        $pengajuans = $ruangan->concat($support)->concat($lab);

        // 5. Custom sort: pending_admin first, then newly creating
        // Define status priority
        $statusPriority = [
            'pending_admin' => 1,
            'disetujui' => 2,
            'ditolak' => 3,
            'batal' => 4,
            'selesai' => 5,
        ];

        $pengajuans = $pengajuans->sort(function ($a, $b) use ($statusPriority) {
            // Primary sort: Status priority
            $priorityA = $statusPriority[$a->status] ?? 99;
            $priorityB = $statusPriority[$b->status] ?? 99;

            if ($priorityA === $priorityB) {
                // Secondary sort: Created At desc
                return $b->created_at <=> $a->created_at;
            }

            return $priorityA <=> $priorityB;
        });

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

    private function findPengajuan($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::find($id);
        if ($pengajuan) {
            $pengajuan->type = 'ruangan';
            return $pengajuan;
        }

        $pengajuan = \App\Models\PengajuanPeminjamanSupport::find($id);
        if ($pengajuan) {
            $pengajuan->type = 'support';
            return $pengajuan;
        }

        $pengajuan = \App\Models\PengajuanPeminjamanLaboratorium::find($id);
        if ($pengajuan) {
            $pengajuan->type = 'laboratorium';
            return $pengajuan;
        }

        return null;
    }

    public function approve($id)
    {
        $pengajuan = $this->findPengajuan($id);

        if (!$pengajuan) {
            abort(404);
        }

        // Hanya boleh approve jika status pending_admin (sudah disetujui kaprodi)
        if ($pengajuan->status !== 'pending_admin') {
            return back()->with('error', 'Hanya pengajuan yang sudah disetujui Kaprodi (pending admin) yang bisa disetujui Admin.');
        }

        $pengajuan->status = 'disetujui';
        $pengajuan->catatan_admin = request('catatan_admin');

        // Ensure type attribute is unset before saving
        unset($pengajuan->type);

        $pengajuan->save();

        // Kirim notifikasi ke user terkait
        if ($pengajuan->user) {
            $pengajuan->user->notify(new StatusPengajuanNotification($pengajuan->status));
        }

        return redirect()->route('admin.pengajuan-ruangan.index')
            ->with('success', 'Pengajuan berhasil disetujui');
    }

    public function reject($id)
    {
        $pengajuan = $this->findPengajuan($id);

        if (!$pengajuan) {
            abort(404);
        }

        $pengajuan->status = 'ditolak'; // pastikan konsisten dengan badge di Blade kamu
        $pengajuan->catatan_admin = request('catatan_admin');

        // Ensure type attribute is unset before saving
        unset($pengajuan->type);

        $pengajuan->save();

        if ($pengajuan->user) {
            $pengajuan->user->notify(new StatusPengajuanNotification($pengajuan->status));
        }

        return redirect()->route('admin.pengajuan-ruangan.index')
            ->with('success', 'Pengajuan berhasil ditolak');
    }

    public function showAdmin($id)
    {
        $pengajuan = $this->findPengajuan($id);

        if (!$pengajuan) {
            abort(404);
        }

        // Load relationships based on type
        if ($pengajuan->type === 'ruangan') {
            $pengajuan->load(['kelas', 'prodi', 'user']);
        } elseif ($pengajuan->type === 'support') {
            $pengajuan->load(['support', 'prodi', 'user']);
            $pengajuan->room_name = $pengajuan->support->nama_ruangan;
            $pengajuan->setRelation('kelas', $pengajuan->support);
        } elseif ($pengajuan->type === 'laboratorium') {
            $pengajuan->load(['laboratorium', 'prodi', 'user']);
            $pengajuan->room_name = $pengajuan->laboratorium->nama_laboratorium;
            $pengajuan->setRelation('kelas', $pengajuan->laboratorium);
        }

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
