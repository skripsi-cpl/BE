<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');
Route::get('/api/tahun-ajaran', function () {
    $startYear = date('Y') - 10; // Tahun mulai 10 tahun ke belakang dari tahun saat ini
    $endYear = date('Y') + 10; // Tahun akhir 10 tahun ke depan dari tahun saat ini
    $years = range($startYear, $endYear);
    
    $tahunAjaran = array_map(function ($year) {
        return $year . '/' . ($year + 1); // Format tahun ajaran (contoh: 2022/2023)
    }, $years);

    return response()->json($tahunAjaran);
});
