<?php

use App\Http\Controllers\CapaianMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CapaianPembelajaranController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;






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
Route::post('inputdataobe',[CapaianPembelajaranController::class,'inputdataobe']);
Route::post('login',[UserController::class,'login']);
Route::get('dashboardmhs/pencapaian',[CapaianMahasiswa::class,'capaianmahasiswa']);
Route::get('mahasiswa',[MahasiswaController::class,'index']);
Route::get('dashboardmhs/filtersemester',[CapaianMahasiswa::class,'filtersemester']);
Route::get('/mata_kuliah', [MataKuliahController::class, 'getMataKuliahBySemester']);
Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');