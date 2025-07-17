<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu apakah admin sudah ada
        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            echo "✔️ User admin berhasil dibuat (username: admin, password: admin123)\n";
        } else {
            echo "⚠️ User admin sudah ada, tidak dibuat ulang.\n";
        }
    }
}
