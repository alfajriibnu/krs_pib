<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenKrsController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        $krs = Krs::with('mahasiswa.user', 'tahunAkademik')
            ->whereHas('mahasiswa', function ($q) use ($dosen) {
                $q->where('dosen_wali_id', $dosen->id);
            })
            ->where('status', 'diajukan')
            ->orderByDesc('created_at')
            ->get();

        return view('dosen.krs.index', compact('krs'));
    }

    public function show(Krs $krs)
    {
        $krs->load('mahasiswa.prodi', 'details.mataKuliah');
        return view('dosen.krs.show', compact('krs'));
    }

    public function verifikasi(Request $request, Krs $krs)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $krs->update([
            'status' => $request->status,
        ]);

        return redirect()->route('dosen.krs.index')->with('success', 'Status KRS berhasil diperbarui.');
    }
}
