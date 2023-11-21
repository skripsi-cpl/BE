<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'NIM',
        'nama_mhs',
        'tahun_masuk',
        'email', 
        'no_hp',
        'kode_wali',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kode_wali', 'kode_wali');
    }

    public $timestamps = false;
}


