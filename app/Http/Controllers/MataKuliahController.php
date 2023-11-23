<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;


class MataKuliahController extends Controller
{
    // MataKuliahController.php

    public function getMataKuliahBySemester(Request $request)
    {
        try {
            $semester = $request->input('semester');
    
            // Pastikan semester yang valid (contoh: 1-8)
            if (!in_array($semester, range(1, 8))) {
                return response()->json(['error' => 'Invalid semester'], 400);
            }
    
            $mataKuliah = MataKuliah::where('semester_mk', $semester)->get();
            return response()->json($mataKuliah);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
