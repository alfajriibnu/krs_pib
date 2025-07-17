<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::with('prodi')->orderBy('kode_mk')->get();
        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.matakuliah.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk|max:10',
            'nama' => 'required|string|max:100',
            'sks'  => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:14',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $matakuliah)
    {
        $prodi = Prodi::all();
        return view('admin.matakuliah.edit', compact('matakuliah', 'prodi'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $request->validate([
            'kode_mk' => 'required|max:10|unique:mata_kuliah,kode_mk,' . $matakuliah->id,
            'nama' => 'required|string|max:100',
            'sks'  => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:14',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
