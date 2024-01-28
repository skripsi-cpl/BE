<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    //

    public function index()
    {
        $kelas = Kelas::all('id_kelas', 'nama_kelas');
        return response()->json($kelas);
    }
    public function getKelasWithStatus(Request $request) {
        $id_mk = $request->input('id_mk');
        $periode = $request->input('tahun_ajaran');
        
        
        $tahunAjaran = TahunAjaran::where('id_TA', $periode)->first();
        if (!$tahunAjaran) {
            return response()->json(['error' => 'Periode tidak ditemukan'], 404);
        }
    
        $kelasWithStatus = Kelas::select('kelas.id_kelas', 'kelas.nama_kelas', 'dpna.waktu_upload')
            ->leftJoin('dpna', function($join) use ($id_mk, $tahunAjaran) {
                $join->on('kelas.nama_kelas', '=', 'dpna.kelas')
                     ->where('dpna.id_mk', '=', $id_mk)
                     // Pastikan kolom ini sesuai dengan yang ada di tabel dpna
                     ->where('dpna.id_TA', '=', $tahunAjaran->id_TA);
            })
            ->get();
    
        foreach ($kelasWithStatus as $kelas) {
            // Tambahkan logika untuk menentukan status upload
            $kelas->status_upload = $kelas->waktu_upload ? "Sudah - " . $kelas->waktu_upload : "Belum";
        }
    
        return response()->json($kelasWithStatus);
    }
    
}    