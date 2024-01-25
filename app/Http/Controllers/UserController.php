<?php

namespace App\Http\Controllers;

use App\Models\CapaianMatakuliah;
use App\Models\CapaianPembelajaran;
use App\Models\CpmkMk;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    function register(request $req){
        $user = new User;
        $user ->email= $req->input('email');
        $user ->password= Hash::make($req->input('password'));
        $user ->peran= $req->input('peran');
        $user->save();
        return $user;

    }

    function login(Request $req){
        $user = User::where('email', $req->email)->first();
        $student = Mahasiswa::where('email', $req->email)->first();
        $lecturer = Dosen::where('email', $req->email)->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return ["Error" => "Maaf, email atau password salah"];
        }

        // Mengekstrak domain dari alamat email pengguna
        $emailParts = explode('@', $user->email);
        $domain = end($emailParts);
        $redirectTo = "";
        $name = "";
        $nim="";

        if ($domain === 'students.undip.ac.id' && $student) {
            $name = $student->nama_mhs;
            $nim = $student->NIM;

            return ["redirectTo" => "dashboardmhs","name" => $name,"nim" =>$nim ,"role" => "mahasiswa"] ;
        } elseif ($domain === 'lecturer.undip.ac.id' && $lecturer) {
            
            $name = $lecturer->nama_dosen;
            $nip = $lecturer->NIP;
            $kode_wali = $lecturer->kode_wali;
            $totalMahasiswa = Mahasiswa::where('kode_wali', $lecturer->kode_wali)
            ->count();
            return ["redirectTo" => "dashboarddosen","name" => $name,"nip" =>$nip ,"role" => "dosen","kode"=>$kode_wali,"totalMahasiswa"=>$totalMahasiswa];
        } elseif ($domain === 'departemen.undip.ac.id') {
            $name = $user->email;
            $totalMahasiswa = Mahasiswa::count();
            $totalMK= MataKuliah::count();
            $totalDosen = Dosen::count();
            return ["redirectTo" => "dashboarddepartment","name" => $name, "role" => "departemen","totalDosen"=>$totalDosen,"totalMahasiswa"=>$totalMahasiswa,"totalMK"=>$totalMK];
        } elseif ($domain === 'operator.undip.ac.id') {
            $name = $user->email;
            $totalMahasiswa = Mahasiswa::count();
            $totalCPL= CapaianPembelajaran::count();
            $totalCPMK= CapaianMatakuliah::count();
            $totalMK= MataKuliah::count();

            return ["redirectTo" => "dashboard","name" => $name, "role" => "operator","totalMahasiswa"=>$totalMahasiswa,"totalCPL"=>$totalCPL,"totalCPMK"=>$totalCPMK,"totalMK"=>$totalMK];
        }else {
            return ["Error" => "Format email tidak sesuai"];
        }
    }
}
