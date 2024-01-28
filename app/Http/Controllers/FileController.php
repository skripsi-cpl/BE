<?php

// app/Http/Controllers/FileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:10240', 
        ]);

        try {
            // Simpan file ke penyimpanan (storage/app/public)
            $file = $request->file('file')->store('public');

            // Simpan informasi file ke database
            FileUpload::create([
                'file_upload' => basename($file),
                
            ]);

            return response()->json(['message' => 'File uploaded successfully']);
        } catch (\Exception $e) {
            // Tambahkan log untuk mencetak informasi kesalahan
            Log::error('Error uploading file: ' . $e->getMessage());

            return response()->json(['message' => 'Error uploading file', 'error' => $e->getMessage()], 422);
        }
    }
}
