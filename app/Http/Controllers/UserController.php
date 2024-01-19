<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            return ["redirectTo" => "dashboarddosen","name" => $name, "role" => "dosen"];
        } elseif ($domain === 'departemen.undip.ac.id') {
            $name = $user->email;
            return ["redirectTo" => "dashboarddepartment","name" => $name, "role" => "departemen"];
        } elseif ($domain === 'operator.undip.ac.id') {
            $name = $user->email;
            return ["redirectTo" => "dashboard","name" => $name, "role" => "operator"];
        }else {
            return ["Error" => "Format email tidak sesuai"];
        }
    }
}
