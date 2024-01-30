<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::all();
        return response()->json($kurikulum);
    }
    //
    public function postDataKurikulum(Request $request)
    {
        // Memvalidasi input - contoh penggunaan aturan validasi
        $validatedData = $request->validate([
            'id_kurikulum' => 'required', // 'required' berarti wajib diisi
            'nama_kurikulum' => 'required',
        ]);

        // Simpan data ke masing-masing model
        $kurikulum = Kurikulum::create([
            'id_kurikulum' => $validatedData['id_kurikulum'],
            'nama_kurikulum' => $validatedData['nama_kurikulum'],
        ]);
        $kurikulum->makeHidden(['id']);

        // Jika Anda ingin memberikan respons berupa pesan atau hasil lainnya
        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $kurikulum
        ]);
    }
}
