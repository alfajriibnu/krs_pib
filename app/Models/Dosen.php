<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'nidn',
        'nama',
        'prodi_id',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mahasiswa yang dibimbing
    public function mahasiswaBimbingan()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id');
    }
}
