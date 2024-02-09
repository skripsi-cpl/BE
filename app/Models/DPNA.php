<?php

namespace App\Models;

use App\Http\Controllers\CapaianMahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class DPNA extends Model
{
    protected $table = 'dpna';

    protected $fillable = [
        'id_TA',
        'id_cpmk_mk',
        'id_mk',
        'NIM',
        'kelas',
        'tugas',
        'praktikum',
        'UTS',
        'UAS',
        'nilai_angka',
        'nilai_huruf',
        'status'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }

    public function cpmkmk()
    {
        return $this->belongsTo(CpmkMk::class, 'id_cpmk_mk', 'id_cpmk_mk');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($dpna) {
            $dpna->handleAfterInsert();
        });
    }

    public function handleAfterInsert()
    {
        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('NIM', $this->NIM)->first();
        $mata_kuliah = MataKuliah::where('id_mk', $this->id_mk)->first();
        $cpmkmk = CpmkMk::where('id_cpmk_mk', $this->id_cpmk_mk)->first();

        // Ambil id_cpmk dari CpmkMk
        $id_cpmk = $cpmkmk->id_cpmk;

        // Cari Cpmk berdasarkan id_cpmk
        $cpmk = CapaianMatakuliah::where('id_cpmk', $id_cpmk)->first();
        $id_cpl = $cpmk->id_cpl;
        $bobot_mk = $cpmkmk->bobot_mk;
        $nilai_bobot_mk = $this->nilai_angka * $bobot_mk;


        // Cari Capaian Pembelajaran berdasarkan id_cpl
        $capaian_pembelajaran = CapaianPembelajaran::where('id_cpl', $id_cpl)->first();
        $bobot_cpmk = $cpmk->bobot_cpmk;
        // Ambil id_pl dari Capaian Pembelajaran
        $id_pl = $capaian_pembelajaran->id_pl;


        $kode_wali = $mahasiswa->kode_wali;
        $id_kurikulum = $mata_kuliah->id_kurikulum;
        $id_TA = $mahasiswa->id_TA;
        $id_cpmk_mk = $cpmkmk->id_cpmk_mk;
        $nilai_cpl = $this->nilai_angka * $bobot_mk * $bobot_cpmk;

        // Buat record baru di tabel Trxdpna
        Trxdpna::create([
            'id_dpna' => $this->id,
            'id_mk' => $this->id_mk,
            'kode_wali' => $kode_wali,
            'NIM' => $this->NIM,
            'id_pl' => $id_pl, // Tambahkan kolom id_pl
            'id_cpl' => $id_cpl,
            'id_cpmk' => $id_cpmk,
            'id_cpmk_mk' => $id_cpmk_mk,
            'id_kurikulum' => $id_kurikulum,
            'id_TA' => $id_TA,
            'nilai_cpl' => $nilai_cpl,
            // Tambahkan kolom lain yang sesuai
        ]);
    }



    public $timestamps = false;
}