<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function getMataKuliahBySemester(Request $request)
{
    try {
        $semesterType = $request->input('semester_type');

        // Validasi semesterType
        if (!in_array($semesterType, ['genap', 'ganjil'])) {
            return response()->json(['error' => 'Invalid semester_type'], 400);
        }

        // Filter mata kuliah berdasarkan semester_type
        if ($semesterType === 'genap') {
            // Jika $semesterType adalah 'genap'
            $mataKuliah = MataKuliah::whereIn('semester_mk', [2, 4, 6, 8])->get();
        } else {
            // Jika $semesterType adalah 'ganjil' atau nilai lainnya
            $mataKuliah = MataKuliah::whereIn('semester_mk', [1, 3, 5, 7])->get();
        }        
        return response()->json($mataKuliah);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


}
