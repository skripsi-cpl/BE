<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trxdpna extends Model
{
    protected $table = 'trxdpna';

    protected $fillable = [
        'id_pl',
        'id_cpl',
        'id_cpmk',
        'kode_wali',
        'NIM',
        'id_kurikulum',
        'id_mk',
        'id_dpna',
        
    ];

    public function pl()
    {
        return $this->belongsTo(ProfileLulusan::class, 'id_pl', 'id_pl');
    }
    public function cpl()
    {
        return $this->belongsTo(CapaianPembelajaran::class, 'id_cpl', 'id_cpl');
    }
    public function cpmk()
    {
        return $this->belongsTo(CPL::class, 'id_cpmk', 'id_cpmk');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kode_wali', 'kode_wali');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'id_kurikulum', 'id_kurikulum');
    }
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
    public function dpna()
    {
        return $this->belongsTo(DPNA::class, 'id_dpna', 'id_dpna');
    }

    public $timestamps = false;
}


