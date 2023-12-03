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
        ->join('tahun_ajaran as ta', 'mhs.semester_TA', '=', 'ta.semester_TA')
        ->get();
        return $data;
    }
    public function indexTa()
    {
        $data = Mahasiswa::from('mahasiswa as mhs')
        ->select('mhs.NIM', 'mhs.nama_mhs', 'mhs.tahun_masuk','ta.periode')
        ->join('tahun_ajaran as ta', 'mhs.semester_TA', '=', 'ta.semester_TA')
        ->get();
        return $data;
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



}