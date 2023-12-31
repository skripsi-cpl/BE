<?php
namespace App\Http\Controllers;

use App\Models\CapaianPembelajaran;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\MahasiswaMataKuliah;

class CapaianMahasiswa extends Controller
{
    public function capaianmahasiswa(Request $request)
    {
        $semester = $request->input('semester_mk'); 
        $nim = $request->input('NIM');
        $data = MataKuliah::from('mata_kuliah as mk')
        ->select('mk.kode_mk', 'mk.nama_mk', 'mk.sks', 'ck.id_cpl', 'cl.bobot_cpl','mk.semester_mk')
        ->join('cpmk as ck', 'mk.id_cpmk', '=', 'ck.id_cpmk')
        ->join('cpl as cl', 'ck.id_cpl', '=', 'cl.id_cpl')
        ->join('mahasiswa_mata_kuliah as mhsmk', 'mhsmk.id_mk', '=', 'mk.id_mk')
        ->where('mk.semester_mk', $semester)
        ->where('mhsmk.NIM', $nim)
        ->get();
            
        
        if($data->count() > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Query berhasil!',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang ditemukan!'
            ]);
        }
    }
    public function filtersemester()
    {
        $data = TahunAjaran::from('tahun_ajaran')
        ->select('semester_TA')
        ->get();
        return $data;
    }
    public function getIdCpl()
    {
        $data = CapaianPembelajaran::from('cpl')
        ->select('id_cpl')
        ->get();
        return $data;
    }
    public function getBobotCpl()
    {
        $data = MataKuliah::from('mata_kuliah as mk')
        ->select('mk.nama_mk',  'ck.id_cpl', 'cl.bobot_cpl')
        ->join('cpmk as ck', 'mk.id_cpmk', '=', 'ck.id_cpmk')
        ->join('cpl as cl', 'ck.id_cpl', '=', 'cl.id_cpl')
        ->join('mahasiswa_mata_kuliah as mhsmk', 'mhsmk.id_mk', '=', 'mk.id_mk')
        ->get();
        return $data;
    }
}
    