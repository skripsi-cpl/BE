<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
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
    \Log::info("Request for semester: $semester");
    
    $mataKuliah = MataKuliah::where('semester_mk', $semester)->get();
    \Log::info("Response from API: " . json_encode($mataKuliah));
    
    return response()->json($mataKuliah);
}



}