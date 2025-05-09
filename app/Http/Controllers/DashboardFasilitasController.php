<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kelas;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;

class DashboardFasilitasController extends Controller
{
    public function index()
    {
        $totalGedung = Gedung::count();
        $totalKelas = Kelas::count();

        return view('dashboardFasilitas', compact(
            'totalGedung',
            'totalKelas',
        ));
    }
}
