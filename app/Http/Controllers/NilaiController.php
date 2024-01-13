<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Dpna; // Model untuk tabel 'dpna'

class NilaiController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $worksheet = $spreadsheet->getActiveSheet();

        $kelas = $worksheet->getCell('B4')->getValue();
        $kelas = str_replace(':', '', $kelas); // Menghilangkan tanda ":"
        
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
            $dpna = new Dpna([
                'NIM' => $nim,
                'kelas' => $kelas,
                'tugas' => $tugas,
                'praktikum' => $praktikum,
                'UTS' => $uts,
                'UAS' => $uas,
                'nilai_angka' => $nilai_angka,
                'nilai_huruf' => $nilai_huruf,
                'status' => "SUDAH",
                // 'status' dan 'waktu_upload' diisi sesuai kebutuhan
            ]);
            $dpna->save();
        }

        return response()->json(['message' => 'Data berhasil diupload']);
    }
}

