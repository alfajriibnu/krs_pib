<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;


class TahunAkademikController extends Controller
{
    public function index()
    {
        $tahunAkademik = TahunAkademik::orderByDesc('tahun')->get();
        return view('admin.tahunakademik.index', compact('tahunAkademik'));
    }

    public function create()
    {
        return view('admin.tahunakademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:9|unique:tahun_akademik,tahun',
            'semester' => 'required|in:ganjil,genap',
            'is_active' => 'nullable|boolean',
        ]);

        // Ambil nilai boolean dari checkbox (checkbox + hidden input combo)
        $is_active = $request->input('is_active') == '1';

        // Jika tahun ini diset aktif, nonaktifkan tahun lainnya
        if ($is_active) {
            TahunAkademik::where('is_active', true)->update(['is_active' => false]);
        }

        TahunAkademik::create([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'is_active' => $is_active,
        ]);

        return redirect()->route('admin.tahunakademik.index')
            ->with('success', 'Tahun akademik berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        return view('admin.tahunakademik.edit', compact('tahunAkademik'));
    }

    public function update(Request $request, TahunAkademik $tahunakademik)
    {
        $request->validate([
            'tahun' => 'required|string|max:9',
            'semester' => 'required|in:ganjil,genap',
            'is_active' => 'nullable|boolean',
        ]);

        // Ambil nilai dari checkbox (checkbox+hidden combo)
        $is_active = $request->input('is_active') == '1';

        // Jika diset aktif, nonaktifkan semua yang lain
        if ($is_active) {
            TahunAkademik::where('is_active', true)
                ->where('id', '!=', $tahunakademik->id)
                ->update(['is_active' => false]);
        }

        $tahunakademik->update([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'is_active' => $is_active,
        ]);

        return redirect()->route('admin.tahunakademik.index')
            ->with('success', 'Tahun akademik berhasil diperbarui.');
    }


    public function destroy(TahunAkademik $tahunakademik)
    {
        $tahunakademik->delete();
        return redirect()->route('admin.tahunakademik.index')->with('success', 'Tahun akademik berhasil dihapus.');
    }
}
