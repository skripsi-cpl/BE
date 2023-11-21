<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'kode_wali',
        'NIP',
        'nama_dosen',
        'email', 
        'id_mk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public $timestamps = false;
}


