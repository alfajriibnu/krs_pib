<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Sementara abaikan pengecekan KRS
        $tahun_aktif = \App\Models\TahunAkademik::where('is_active', true)->first();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'tahun_aktif'));
    }
}
