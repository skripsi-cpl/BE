<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaMataKuliah extends Model
{
    protected $table = 'mahasiswa_mata_kuliah';

    protected $fillable = [
        'id_mhs_mk',
        'NIM',
        'id_mk',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
   

    public $timestamps = false;
}


