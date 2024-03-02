<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::from('mahasiswa as mhs')
            ->select('*')
            ->join('tahun_ajaran as ta', 'mhs.id_TA', '=', 'ta.id_TA')
            ->get();
        return $data;
    }
    public function indexTa()
    {
        $data = Mahasiswa::from('mahasiswa as mhs')
                ->join('tahun_ajaran as ta', 'mhs.id_TA', '=', 'ta.id_TA')
                ->join('dosen as dsn', 'mhs.kode_wali', '=', 'dsn.kode_wali') 
                ->select(
                    'mhs.NIM',
                    'mhs.nama_mhs',
                    'mhs.tahun_masuk',
                    'ta.periode',
                    'dsn.nama_dosen as nama_wali' ,
                    'dsn.kode_wali'
                )
                ->get();
        return response()->json($data); 
    }

    public function getTahunAngkatan()
    {
        $tahunAngkatan = Mahasiswa::select('tahun_masuk')
            ->distinct()
            ->get()
            ->pluck('tahun_masuk');
        return response()->json($tahunAngkatan);
    }

    public function filterMahasiswaByAngkatan(Request $request)
    {
        $tahunAngkatan = $request->input('tahun_angkatan', []);

        $mahasiswa = Mahasiswa::whereIn('tahun_masuk', $tahunAngkatan)
            ->get();

        return response()->json($mahasiswa);
    }
    // MahasiswaController.php
    public function getAllMahasiswa()
    {
        $data = Mahasiswa::from('mahasiswa')
            ->select('tahun_masuk')
            ->get();
        return $data;
    }

    public function getMataKuliahBySemester(Request $request)
    {
        $semester = $request->input('semester');


        $mataKuliah = MataKuliah::where('semester_mk', $semester)->get();

        return response()->json($mataKuliah);
    }
    public function getMahasiswa($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        return response()->json($mahasiswa);
    }
    public function getMahasiswaByKodeWali($kode_wali)
    {
        $mahasiswa = Mahasiswa::where('kode_wali', $kode_wali)->get();

        return response()->json($mahasiswa);
    }


}