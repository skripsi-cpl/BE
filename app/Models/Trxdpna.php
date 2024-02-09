<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trxdpna extends Model
{
    protected $table = 'trxdpna';

    protected $fillable = [
        'id_dpna',
        'id_mk',
        'kode_wali',
        'NIM',
        'id_pl',
        'id_cpl',
        'id_cpmk',
        'id_cpmk_mk',
        'id_kurikulum',
        'id_TA',
        'nilai_cpl'
    ];


    public function dpna()
    {
        return $this->belongsTo(DPNA::class, 'id_dpna', 'id_dpna');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kode_wali', 'kode_wali');
    }

    public $timestamps = false;
}