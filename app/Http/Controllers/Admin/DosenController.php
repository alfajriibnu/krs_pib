<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('prodi')->orderBy('nidn')->get();
        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.dosen.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $user = User::create([
            'username' => $request->nidn,
            'password' => Hash::make($request->nidn), // default password = nidn
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $user->id,
            'nidn' => $request->nidn,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        $prodi = Prodi::all();
        return view('admin.dosen.edit', compact('dosen', 'prodi'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn,' . $dosen->id,
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $dosen->update($request->all());

        $dosen->user->update([
            'username' => $request->nidn
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->user->delete();
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
