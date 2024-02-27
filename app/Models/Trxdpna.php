<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getMahasiswaCPL()
    {
        // Mengambil total nilai_cpl dari tabel trxdpna untuk setiap mahasiswa
        $mahasiswaCPL = Trxdpna::select('NIM', DB::raw('SUM(nilai_cpl) as total_cpl'))
                        ->groupBy('NIM')
                        ->get();

        return response()->json($mahasiswaCPL);
    }
    public $timestamps = false;
}