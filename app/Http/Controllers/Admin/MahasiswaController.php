<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi', 'dosenWali')->orderBy('nim')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        $dosen = Dosen::all();
        return view('admin.mahasiswa.create', compact('prodi', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:100',
            'semester' => 'required|numeric|min:1|max:14',
            'prodi_id' => 'required|exists:prodi,id',
            'dosen_wali_id' => 'nullable|exists:dosen,id',
        ]);

        $user = User::create([
            'username' => $request->nim,
            'password' => Hash::make($request->nim),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'semester' => $request->semester,
            'prodi_id' => $request->prodi_id,
            'dosen_wali_id' => $request->dosen_wali_id,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $prodi = Prodi::all();
        $dosen = Dosen::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'prodi', 'dosen'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:100',
            'semester' => 'required|numeric|min:1|max:14',
            'prodi_id' => 'required|exists:prodi,id',
            'dosen_wali_id' => 'nullable|exists:dosen,id',
        ]);

        $mahasiswa->update($request->all());

        $mahasiswa->user->update([
            'username' => $request->nim
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->user->delete();
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
