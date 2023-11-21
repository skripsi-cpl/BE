<?php

namespace App\Http\Controllers;
use App\Models\ProfileLulusan;
use App\Models\CapaianMatakuliah;
use App\Models\CapaianPembelajaran;
use Illuminate\Http\Request;

class CapaianPembelajaranController extends Controller
{
    //
    public function inputdataobe(Request $request)
    {
        // Memvalidasi input - contoh penggunaan aturan validasi
        $validatedData = $request->validate([
            'id_pl' => 'required',
            'id_cpl' => 'required',
            'id_cpmk' => 'required',
            'nama_pl' => 'required',
            'nama_cpl' => 'required',
            'nama_cpmk' => 'required',
            'bobot_pl' => 'required',
            'bobot_cpl' => 'required',
            'bobot_cpmk' => 'required',
        ]);

        // Simpan data ke masing-masing model
        $profileLulusan = ProfileLulusan::create([
            'id_pl' => $validatedData['id_pl'],
            'nama_pl' => $validatedData['nama_pl'],
            'bobot_pl' => $validatedData['bobot_pl'],
        ]);

        $capaianPembelajaran = CapaianPembelajaran::create([
            'id_cpl' => $validatedData['id_cpl'],
            'nama_cpl' => $validatedData['nama_cpl'],
            'bobot_cpl' => $validatedData['bobot_cpl'],
            'id_pl' => $validatedData['id_pl'],
        ]);

        $capaianMatakuliah = CapaianMatakuliah::create([
            'id_cpmk' => $validatedData['id_cpmk'],
            'nama_cpmk' => $validatedData['nama_cpmk'],
            'bobot_cpmk' => $validatedData['bobot_cpmk'],
            'id_cpl' => $validatedData['id_cpl'],
        ]);

        // Jika Anda ingin memberikan respons berupa pesan atau hasil lainnya
        return response()->json([
            'message' => 'Data has been successfully saved!',
            'pl' => $profileLulusan,
            'cpl' => $capaianPembelajaran,
            'cpmk' => $capaianMatakuliah,
        ], 201); // 201 menunjukkan "Created" status code
    }
}
