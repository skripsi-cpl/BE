<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trxdpna;
use Illuminate\Support\Facades\DB;

class TrxdpnaController extends Controller
{
    
    public function getCPLByNIM(Request $request)
    {
        $nim = $request->input('nim');
        if (!$nim) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter NIM tidak ditemukan',
                'data' => null
            ], 400);
        }

        
        $cplData = Trxdpna::select('NIM', DB::raw('SUM(nilai_cpl) as total_cpl'))
                    ->where('NIM', $nim)
                    ->groupBy('NIM')
                    ->get();
        return response()->json([
            'success' => true,
            'message' => 'Total CPL untuk NIM ' . $nim . ' berhasil diambil',
            'data' => $cplData
        ]);
    }
}
