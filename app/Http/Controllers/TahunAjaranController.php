<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::all('periode');
        return response()->json($tahunAjaran);
    }
}
