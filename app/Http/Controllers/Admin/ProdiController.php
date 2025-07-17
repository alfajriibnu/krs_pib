<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();
        return view('admin.prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('admin.prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100|unique:prodi,nama_prodi',
            'jenjang' => 'required|in:D3,S1Terapan,S1,S2,S3',
        ]);

        Prodi::create($request->all());

        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        return view('admin.prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100|unique:prodi,nama_prodi,' . $prodi->id,
            'jenjang' => 'required|in:D3,S1Terapan,S1,S2,S3',
        ]);

        $prodi->update($request->all());

        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}
