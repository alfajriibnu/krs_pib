<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan ke dashboard berdasarkan role
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'dosen':
                    return redirect()->intended('/dosen/dashboard');
                case 'mahasiswa':
                    return redirect()->intended('/mahasiswa/dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors([
                        'username' => 'Peran pengguna tidak dikenali.',
                    ]);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
