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

        $user = Auth::guard('admin')->user();
        $pengajuans = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
            ->where('status', 'pending_kaprodi')
            ->where('prodi_id', $user->prodi_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('kaprodi.approval.index', compact('pengajuans'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::with(['kelas', 'prodi', 'user'])
            ->findOrFail($id);

        return view('kaprodi.approval.show', compact('pengajuan'));
    }

    public function approve(Request $request, $id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::findOrFail($id);
        $user = Auth::guard('admin')->user();

        if ($pengajuan->prodi_id !== $user->prodi_id) {
            abort(403, 'Anda tidak berhak menyetujui pengajuan prodi lain.');
        }

        if ($pengajuan->status !== 'pending_kaprodi') {
            return back()->with('error', 'Status pengajuan tidak valid untuk disetujui Kaprodi.');
        }

        $pengajuan->status = 'pending_admin'; // Move to next step
        $pengajuan->catatan_kaprodi = $request->input('catatan_kaprodi');
        $pengajuan->save();

        // Optional: Notify Admin or User
        // $pengajuan->user->notify(new StatusPengajuanNotification('pending_admin'));

        return redirect()->route('kaprodi.approval.index')
            ->with('success', 'Pengajuan disetujui, diteruskan ke Admin.');
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = PengajuanPeminjamanRuangan::findOrFail($id);
        $user = Auth::guard('admin')->user();

        if ($pengajuan->prodi_id !== $user->prodi_id) {
            abort(403, 'Anda tidak berhak menolak pengajuan prodi lain.');
        }

        $pengajuan->status = 'ditolak';
        $pengajuan->catatan_kaprodi = $request->input('catatan_kaprodi');
        $pengajuan->save();

        // Notify User
        if ($pengajuan->user) {
            $pengajuan->user->notify(new StatusPengajuanNotification('ditolak'));
        }

        return redirect()->route('kaprodi.approval.index')
            ->with('success', 'Pengajuan ditolak.');
    }
}
