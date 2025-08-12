<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Legalisir;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalPeran     = Role::count();
        $totalPengguna  = User::count();
        $totalDivisi    = Prodi::count();
        $totalLegalisir = Legalisir::count();

        return view('admin.dashboard', compact(
            'totalPeran',
            'totalPengguna',
            'totalDivisi',
            'totalLegalisir'
        ));
    }
}
