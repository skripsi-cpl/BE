<?php

namespace App\Http\Controllers;

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
        $idMk = $request->input('id_mk');
        $kelas = $worksheet->getCell('B4')->getValue();
        $kelas = $request->input('nama_kelas');
        $idTA = $request->input('id_TA');

        $status = DPNA::where('id_mk', $idMk)
            ->where('kelas', $kelas)
            ->exists();
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

            // Membuat record baru di database
            $dpna = new DPNA([
                'id_mk' => $idMk,
                'id_TA' => $idTA,
                'NIM' => $nim,
                'kelas' => $kelas,
                'tugas' => $tugas,
                'praktikum' => $praktikum,
                'UTS' => $uts,
                'UAS' => $uas,
                'nilai_angka' => $nilai_angka,
                'nilai_huruf' => $nilai_huruf,
                'status' => 'Sudah',
                 // Menambahkan id_TA ke dalam data yang akan disimpan
            ]);
            $dpna->save();
            
             // Ambil id baru yang telah disimpan di dpna
             $id_dpna = $dpna->id;

             // Simpan id_dpna ke tabel trxdpna
            //  $trxdpna = new Trxdpna([
            //      'id_dpna' => $id_dpna,
            //      // Tambahkan kolom-kolom lain yang sesuai
            //  ]);
            //  $trxdpna->save();
            //  Status::where('id_status', 1)->update(['nama_status' => 'sudah']);
        }

        return response()->json(
            ['message' => 'Data berhasil diupload']
        );
    }
}

