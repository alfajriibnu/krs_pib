<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfilMahasiswaController extends Controller
{
    public function edit()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        return view('mahasiswa.profil.edit', compact('mahasiswa'));
    }

    public function update(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $request->validate([
            'nama' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:14',
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'semester' => $request->semester,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
