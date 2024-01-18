<?php

namespace App\Http\Controllers;

use App\Models\DPNA;
use Illuminate\Http\Request;

class UploadStatusController extends Controller
{
    //
     public function checkStatus(Request $request)
    {
        
        $idMk = $request->input('id_mk');
        $kelas = $request->input('kelas');
        $status = DPNA::where('id_mk', $idMk)
            ->where('kelas', $kelas)
            ->exists();
        return response()->json(['status' => $status ? 'Sudah' : 'Belum']);
    }
}
