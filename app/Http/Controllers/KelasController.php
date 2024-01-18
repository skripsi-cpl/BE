<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    //
    public function index()
    {
        $kelas = Kelas::all('id_kelas', 'nama_kelas');
        return response()->json($kelas);
    }
}
