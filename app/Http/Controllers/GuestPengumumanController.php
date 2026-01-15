<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class GuestPengumumanController extends Controller
{
    public function index()
    {
        // Only show published announcements
        $pengumumans = Pengumuman::where('status', 'published')
            ->with('author')
            ->orderBy('tanggal_dibuat', 'desc')
            ->get();

        return view('guest.pengumuman.index', compact('pengumumans'));
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::where('status', 'published')->findOrFail($id);
        return view('guest.pengumuman.show', compact('pengumuman'));
    }
}
