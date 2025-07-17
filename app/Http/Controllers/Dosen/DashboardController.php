<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        $totalMahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id)->count();

        return view('dosen.dashboard', compact('totalMahasiswa'));
    }
}
