<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'prodi_id',
        'semester',
        'dosen_wali_id',
    ];

    // Relasi ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    // Relasi ke Dosen Wali
    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'dosen_wali_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
