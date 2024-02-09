<?php

namespace App\Http\Controllers;

use App\Models\CpmkMk;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Dpna; // Model untuk tabel 'dpna'
use App\Models\Status;
use App\Models\Trxdpna; // Model untuk tabel 'trxdpna'

class NilaiController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $worksheet = $spreadsheet->getActiveSheet();
        $kelas = $request->input('nama_kelas');
        $idTA = $request->input('id_TA');

        // Dapatkan daftar id_mk terkait dengan id_mk yang diterima
        // Memastikan bahwa id_mk hanya diproses sekali
        $idMkList = CpmkMk::where('id_mk', $request->input('id_mk'))->pluck('id_mk')->unique()->toArray();

        foreach ($idMkList as $idMk) {
            // Dapatkan semua id_cpmk_mk terkait dengan id_mk saat ini
            $idCpmkMkList = CpmkMk::where('id_mk', $idMk)->pluck('id_cpmk_mk')->toArray();
            
            // Buat variabel untuk menyimpan data per baris yang akan di-insert ke database
            $rowData = [];

            for ($row = 8; $row <= $worksheet->getHighestRow(); $row++) {
                // Baca data dari setiap baris
                $nim = $worksheet->getCell('A' . $row)->getValue();
                $tugas = $worksheet->getCell('E' . $row)->getCalculatedValue();
                $praktikum = $worksheet->getCell('F' . $row)->getCalculatedValue();
                $uts = $worksheet->getCell('G' . $row)->getCalculatedValue();
                $uas = $worksheet->getCell('H' . $row)->getCalculatedValue();
                $nilai_angka = $worksheet->getCell('I' . $row)->getCalculatedValue();
                $nilai_huruf = $worksheet->getCell('J' . $row)->getCalculatedValue();

                // Konversi nilai ke numerik jika perlu
                $nilai_angka = is_numeric($nilai_angka) ? floatval($nilai_angka) : 0;

                // Membuat instance model DPNA untuk setiap baris data
                foreach ($idCpmkMkList as $idCpmkMk) {
                    $dpna = new Dpna();
                    $dpna->id_mk = $idMk;
                    $dpna->id_TA = $idTA;
                    $dpna->NIM = $nim;
                    $dpna->kelas = $kelas;
                    $dpna->tugas = $tugas;
                    $dpna->praktikum = $praktikum;
                    $dpna->UTS = $uts;
                    $dpna->UAS = $uas;
                    $dpna->nilai_angka = $nilai_angka;
                    $dpna->nilai_huruf = $nilai_huruf;
                    $dpna->status = 'Sudah';
                    $dpna->id_cpmk_mk = $idCpmkMk;

                    // Simpan instance model DPNA
                    $dpna->save();
                }
            }
        }

        return response()->json(['message' => 'Data berhasil diupload']);
    }
    public function hitungCPL(){
        $data = CpmkMk::join('cpmk','cpmk_mk.id_cpmk','=','cpmk.id_cpmk')
        ->join('mata_kuliah','cpmk_mk.id_mk','=','mata_kuliah.id_mk')
        ->select('cpmk.id_cpmk','cpmk.bobot_cpmk','mata_kuliah.id_mk','cpmk_mk.id_cpmk_mk','cpmk_mk.bobot_mk')
        ->get();
        return response()->json($data);
    }
}