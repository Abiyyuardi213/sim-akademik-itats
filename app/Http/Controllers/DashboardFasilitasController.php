<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kelas;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;

use App\Models\Support;
use App\Models\Laboratorium;

class DashboardFasilitasController extends Controller
{
    public function index()
    {
        $totalGedung = Gedung::count();
        $totalKelas = Kelas::count();
        $totalSupport = Support::count();
        $totalLaboratorium = Laboratorium::count();

        return view('admin.dashboardFasilitas', compact(
            'totalGedung',
            'totalKelas',
            'totalSupport',
            'totalLaboratorium'
        ));
    }
}
