<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Legalisir;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeran     = Role::count();
        $totalPengguna  = User::count();
        $totalDivisi    = Prodi::count();
        $totalLegalisir = Legalisir::count();

        return view('dashboard', compact(
            'totalPeran',
            'totalPengguna',
            'totalDivisi',
            'totalLegalisir'
        ));
    }
}
