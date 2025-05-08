<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaCuti;
use App\Models\PeriodeCuti;
use Illuminate\Http\Request;

class DashboardCutiController extends Controller
{
    public function index()
    {
        $totalPeriode = PeriodeCuti::count();
        $totalMahasiswaCuti = MahasiswaCuti::count();

        return view('mahasiswa-cuti.dashboard', compact(
            'totalPeriode',
            'totalMahasiswaCuti',
        ));
    }
}
