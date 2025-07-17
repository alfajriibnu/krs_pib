<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'prodi_id',
        'kode_mk',
        'nama',
        'sks',
        'semester',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
