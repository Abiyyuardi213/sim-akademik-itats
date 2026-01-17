<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPeminjamanRuangan;
use App\Notifications\StatusPengajuanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    /**
     * Display a listing of bookings waiting for Kaprodi approval.
     */
    public function indexApproval()
    {
        $user = Auth::guard('admin')->user();
        if ($user->role->role_name !== 'Kaprodi' && $user->role->role_name !== 'Kepala Program Studi') {
            // Fallback or error if not Kaprodi
        }

        // Helper to fetch requests by status
        $fetchRequests = function ($statuses, $exclude = false) use ($user) {
            $operator = $exclude ? 'whereNotIn' : 'whereIn';

            $ruangan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
                ->$operator('status', $statuses)
                ->where('prodi_id', $user->prodi_id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    $item->type = 'ruangan';
                    $item->room_name = $item->kelas->nama_kelas ?? '-';
                    return $item;
                });

            $support = \App\Models\PengajuanPeminjamanSupport::with(['support', 'prodi', 'user'])
                ->$operator('status', $statuses)
                ->where('prodi_id', $user->prodi_id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    $item->type = 'support';
                    $item->room_name = $item->support->nama_ruangan ?? '-';
                    $item->setRelation('kelas', $item->support);
                    return $item;
                });

            $lab = \App\Models\PengajuanPeminjamanLaboratorium::with(['laboratorium', 'prodi', 'user'])
                ->$operator('status', $statuses)
                ->where('prodi_id', $user->prodi_id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    $item->type = 'laboratorium';
                    $item->room_name = $item->laboratorium->nama_laboratorium ?? '-';
                    $item->setRelation('kelas', $item->laboratorium);
                    return $item;
                });

            return $ruangan->concat($support)->concat($lab)->sortByDesc('created_at');
        };

        // Pending Requests (Waiting for Kaprodi)
        $pengajuans = $fetchRequests(['pending_kaprodi']);

        // History Requests (Already processed by Kaprodi or further)
        // We exclude 'pending' (not yet ready for kaprodi) and 'pending_kaprodi' (handled above)
        // So effectively: pending_admin, disetujui, ditolak, selesai, batal
        $histories = $fetchRequests(['pending', 'pending_kaprodi'], true);

        return view('kaprodi.approval.index', compact('pengajuans', 'histories'));
    }

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
            // Map for view compatibility if needed, but safer to handle in view or simple mapping
            // $pengajuan->setRelation('kelas', $pengajuan->support); 
            return $pengajuan;
        }

        $pengajuan = \App\Models\PengajuanPeminjamanLaboratorium::find($id);
        if ($pengajuan) {
            $pengajuan->type = 'laboratorium';
            // $pengajuan->setRelation('kelas', $pengajuan->laboratorium);
            return $pengajuan;
        }

        return null;
    }

    public function show($id)
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
            $pengajuan->setRelation('kelas', $pengajuan->support); // Hack for existing views expecting 'kelas'
        } elseif ($pengajuan->type === 'laboratorium') {
            $pengajuan->load(['laboratorium', 'prodi', 'user']);
            $pengajuan->room_name = $pengajuan->laboratorium->nama_laboratorium;
            $pengajuan->setRelation('kelas', $pengajuan->laboratorium); // Hack for existing views
        }

        return view('kaprodi.approval.show', compact('pengajuan'));
    }

    public function approve(Request $request, $id)
    {
        $pengajuan = $this->findPengajuan($id);

        if (!$pengajuan) {
            abort(404);
        }

        $user = Auth::guard('admin')->user();

        if ($pengajuan->prodi_id !== $user->prodi_id) {
            abort(403, 'Anda tidak berhak menyetujui pengajuan prodi lain.');
        }

        if ($pengajuan->status !== 'pending_kaprodi') {
            return back()->with('error', 'Status pengajuan tidak valid untuk disetujui Kaprodi.');
        }

        $pengajuan->status = 'pending_admin'; // Move to next step
        $pengajuan->catatan_kaprodi = $request->input('catatan_kaprodi');
        unset($pengajuan->type); // Remove temporary attribute before saving
        $pengajuan->save();

        // Optional: Notify Admin or User
        if ($pengajuan->user) {
            $pengajuan->user->notify(new StatusPengajuanNotification('pending_admin'));
        }

        return redirect()->route('kaprodi.approval.index')
            ->with('success', 'Pengajuan disetujui, diteruskan ke Admin.');
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = $this->findPengajuan($id);

        if (!$pengajuan) {
            abort(404);
        }

        $user = Auth::guard('admin')->user();

        if ($pengajuan->prodi_id !== $user->prodi_id) {
            abort(403, 'Anda tidak berhak menolak pengajuan prodi lain.');
        }

        $pengajuan->status = 'ditolak';
        $pengajuan->catatan_kaprodi = $request->input('catatan_kaprodi');
        unset($pengajuan->type); // Remove temporary attribute before saving
        $pengajuan->save();

        // Notify User
        if ($pengajuan->user) {
            $pengajuan->user->notify(new StatusPengajuanNotification('ditolak'));
        }

        return redirect()->route('kaprodi.approval.index')
            ->with('success', 'Pengajuan ditolak.');
    }
}
