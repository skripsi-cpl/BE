<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::all();
        return response()->json($tahunAjaran);
    }
    public function postDataTahunAjaran(Request $request)
    {
        // Memvalidasi input - contoh penggunaan aturan validasi
        $validatedData = $request->validate([
            'periode' => 'required',
        ]);

        // Simpan data ke masing-masing model
        $tahunAjaran = TahunAjaran::create([
            'periode' => $validatedData['periode'],
        ]);

        // Jika Anda ingin memberikan respons berupa pesan atau hasil lainnya
        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $tahunAjaran
        ]);
    }
}
