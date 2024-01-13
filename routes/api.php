<?php

use App\Http\Controllers\CapaianMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CapaianPembelajaranController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\TahunAjaranController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserController::class,'register']);


//master data
//get router
Route::get('datapl',[CapaianPembelajaranController::class,'getDataPL']);
Route::get('datacpl',[CapaianPembelajaranController::class,'getDataCPL']);
Route::get('datacpmk',[CapaianPembelajaranController::class,'getDataCPMK']);
Route::get('datamk',[CapaianPembelajaranController::class,'getDataMK']);
Route::get('datamatakuliah',[CapaianPembelajaranController::class,'getDataMataKuliah']);
//post router
Route::post('datapostpl',[CapaianPembelajaranController::class,'postDataPL']);
Route::post('datapostcpl',[CapaianPembelajaranController::class,'postDataCPL']);
Route::post('datapostcpmk',[CapaianPembelajaranController::class,'postDataCPMK']);
Route::post('datapostmk',[CapaianPembelajaranController::class,'postDataMK']);

Route::post('login',[UserController::class,'login']);
Route::get('dashboardmhs/pencapaian',[CapaianMahasiswa::class,'capaianmahasiswa']);
Route::get('mahasiswa',[MahasiswaController::class,'index']);
Route::get('mahasiswa/indexTa',[MahasiswaController::class,'indexTa']);
Route::get('dashboardmhs/filtersemester',[CapaianMahasiswa::class,'filtersemester']);
Route::get('dashboardmhs/getIdCpl',[CapaianMahasiswa::class,'getIdCpl']);
Route::get('dashboardmhs/getBobotCpl',[CapaianMahasiswa::class,'getBobotCpl']);
Route::get('/mata_kuliah', [MataKuliahController::class, 'getMataKuliahBySemester']);
Route::post('/upload', [FileController::class, 'upload']);
Route::get('/tahun-ajaran-data', [TahunAjaranController::class, 'index']);
Route::post('/upload-nilai', [NilaiController::class, 'upload']);
Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');
