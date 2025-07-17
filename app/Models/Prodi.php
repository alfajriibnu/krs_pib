<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = [
        'nama_prodi',
        'jenjang',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    // Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}
