<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;

class MataKuliahController extends Controller
{
    // Dalam controller Laravel yang mengelola data mata kuliah

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_ta', 'id_TA');
    }

    public function getMataKuliahBySemesterType(Request $request)
    {
        try {
            $idTaPeriode = $request->input('id_ta');

            // Ambil tahun ajaran berdasarkan periode
            $tahunAjaran = TahunAjaran::where('id_TA', $idTaPeriode)->first();

            if (!$tahunAjaran) {
                return response()->json(['error' => 'Tahun ajaran not found'], 404);
            }

            // Tentukan kondisi semester berdasarkan modulo 2 dari id_TA
            $isEvenSemester = $tahunAjaran->id_TA % 2 == 0;
            $semesterCondition = $isEvenSemester ? [2, 4, 6, 8] : [1, 3, 5, 7];

            // Filter mata kuliah berdasarkan semester
            $mataKuliah = MataKuliah::whereIn('semester_mk', $semesterCondition)->get();

            return response()->json($mataKuliah);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}

