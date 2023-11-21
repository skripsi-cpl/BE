<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
    


}