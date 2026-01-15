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

        return view('dashboard-user', compact('rekomendasi_ruangan'));
    }
}
