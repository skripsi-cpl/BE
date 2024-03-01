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

        // Pastikan NIM tersedia dalam request
        if (!$nim) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter NIM tidak ditemukan',
                'data' => null
            ], 400);
        }

        // Subquery untuk mendapatkan nilai_cpl terbaru untuk setiap mahasiswa berdasarkan id_cpmk_mk
        $latestCPL = Trxdpna::select(DB::raw('SUM(CASE WHEN trxdpna.id_trx = latest_ids.max_id_trx THEN nilai_cpl ELSE 0 END) AS total_cpl'))
                        ->joinSub(function ($query) {
                            $query->select('NIM', 'id_cpmk_mk', DB::raw('MAX(id_trx) AS max_id_trx'))
                                ->from('trxdpna')
                                ->groupBy('NIM', 'id_cpmk_mk');
                        }, 'latest_ids', function ($join) {
                            $join->on('trxdpna.NIM', '=', 'latest_ids.NIM')
                                ->on('trxdpna.id_cpmk_mk', '=', 'latest_ids.id_cpmk_mk');
                        })
                        ->where('trxdpna.NIM', $nim)
                        ->groupBy('trxdpna.NIM');

        // Mengambil hasil total_cpl
        $cplData = $latestCPL->first();

        // Jika tidak ada data yang ditemukan
        if (!$cplData) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan untuk NIM tersebut',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Total CPL untuk NIM ' . $nim . ' berhasil diambil',
            'data' => $cplData
        ]);
    }
}