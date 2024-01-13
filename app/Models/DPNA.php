<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DPNA extends Model
{
    protected $table = 'dpna';

    protected $fillable = [
        // 'id_dpna',
        'id_mk',
        'NIM',
        'tugas',
        'praktikum',
        'UTS',
        'UAS',
        'nilai_angka',
        'nilai_huruf',
        'file_upload',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }

    public $timestamps = false;
}


