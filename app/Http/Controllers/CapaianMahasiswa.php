<?php

namespace App\Http\Controllers;

use App\Models\CapaianPembelajaran;
use App\Models\CpmkMk;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\MahasiswaMataKuliah;
use Illuminate\Support\Facades\DB;

class CapaianMahasiswa extends Controller
{
    public function capaianmahasiswa(Request $request)
    {
        $semester = $request->input('semester_mk');
        $nim = $request->input('NIM');

        $data = CpmkMk::from('trxdpna as trx')
            ->select('mk.kode_mk', 'mk.nama_mk', 'mk.sks', 'ck.id_cpl', 'trx.nilai_cpl', 'mk.semester_mk')
            ->join('mata_kuliah as mk', 'mk.id_mk', '=', 'trx.id_mk') // Gabungkan dengan tabel matakuliah
            ->join('cpmk as ck', 'ck.id_cpmk', '=', 'trx.id_cpmk') // Gabungkan dengan tabel cpmk
            ->join('cpl as cl', 'cl.id_cpl', '=', 'trx.id_cpl') // Gabungkan dengan tabel cpl
            ->join('mahasiswa_mata_kuliah as mhsmk', 'mhsmk.id_mk', '=', 'mk.id_mk') // Gabungkan dengan tabel mahasiswa_mata_kuliah
            ->where('mk.semester_mk', $semester)
            ->where('trx.NIM', $nim)
            ->get();



        if ($data->count() > 0) {
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

    public function getTotalNilaiCPLPerIdCPL(Request $request)
    {
        $nim = $request->input('NIM');
        $data = CpmkMk::from('trxdpna as trx')
            ->select('cl.nama_cpl', 'cl.id_cpl', DB::raw('SUM(trx.nilai_cpl) as total_nilai_cpl'))
            ->join('cpl as cl', 'cl.id_cpl', '=', 'trx.id_cpl') // Gabungkan dengan tabel cpl // Mengambil id_cpl dan jumlah nilai_cpl
            ->groupBy('cl.id_cpl', 'cl.nama_cpl') // Mengelompokkan berdasarkan id_cpl
            ->where('trx.NIM', $nim)
            ->get();

        if ($data->count() > 0) {
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

    public function getTotalNilaiCPLAll(Request $request)
    {
        $data = CpmkMk::from('trxdpna as trx')
            ->select('trx.NIM', 'cl.nama_cpl', 'cl.id_cpl', DB::raw('SUM(trx.nilai_cpl) as total_nilai_cpl'))
            ->join('cpl as cl', 'cl.id_cpl', '=', 'trx.id_cpl') // Gabungkan dengan tabel cpl // Mengambil id_cpl dan jumlah nilai_cpl
            ->groupBy('cl.id_cpl', 'cl.nama_cpl', 'trx.NIM') // Mengelompokkan berdasarkan id_cpl
            ->get();

        if ($data->count() > 0) {
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

    public function getDataGeneratePdf(Request $request)
    {

        $nim = $request->input('NIM');

        $data = CpmkMk::from('trxdpna as trx')
            ->select('mk.kode_mk', 'mk.nama_mk', 'ck.id_cpl', 'trx.nilai_cpl', 'dsn.nama_dosen')
            ->join('mata_kuliah as mk', 'mk.id_mk', '=', 'trx.id_mk') // Gabungkan dengan tabel matakuliah
            ->join('cpmk as ck', 'ck.id_cpmk', '=', 'trx.id_cpmk') // Gabungkan dengan tabel cpmk
            ->join('cpl as cl', 'cl.id_cpl', '=', 'trx.id_cpl')
            ->join('mahasiswa as mhs', 'mhs.NIM', '=', 'trx.NIM') // Gabungkan dengan tabel cpl
            ->join('dosen as dsn', 'dsn.kode_wali', '=', 'trx.kode_wali') // Gabungkan dengan tabel cpl
            ->join('mahasiswa_mata_kuliah as mhsmk', 'mhsmk.id_mk', '=', 'mk.id_mk') // Gabungkan dengan tabel mahasiswa_mata_kuliah
            ->where('trx.NIM', $nim)
            ->get();



        if ($data->count() > 0) {
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
            ->select('id_TA')
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
        $data = CpmkMk::from('cpmk_mk as cmk')
            ->select('mk.nama_mk',  'ck.id_cpl', 'cl.bobot_cpl')
            ->join('mata_kuliah as mk', 'mk.id_mk', '=', 'cmk.id_mk')
            ->join('cpmk as ck', 'cmk.id_cpmk', '=', 'ck.id_cpmk')
            ->join('cpl as cl', 'ck.id_cpl', '=', 'cl.id_cpl')
            ->join('mahasiswa_mata_kuliah as mhsmk', 'mhsmk.id_mk', '=', 'mk.id_mk')
            ->get();
        return $data;
    }
}