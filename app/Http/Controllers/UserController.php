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

        if (!$user || !Hash::check($req->password, $user->password)) {
            return ["Error" => "Maaf, email atau password salah"];
        }

        // Mengekstrak domain dari alamat email pengguna
        $emailParts = explode('@', $user->email);
        $domain = end($emailParts);

        $redirectTo = "";
        $name = "";
    
        if ($domain === 'students.undip.ac.id') {
            $student = Mahasiswa::where('email', $req->email)->first();
            if ($student) {
                
                $name = $student->nama_mhs;
                $redirectTo = "dashboardmhs";
            }
        } elseif ($domain === 'lecturer.undip.ac.id') {
            $lecturer = Dosen::where('email', $req->email)->first();
            if ($lecturer) {
                $name = $lecturer->nama_dosen;
                $redirectTo = "dashboarddosen";
            }
        } elseif ($domain === 'departemen.undip.ac.id') {
            return ["redirectTo" => "dashboarddepartment"];
        } elseif ($domain === 'operator.undip.ac.id') {
            return ["redirectTo" => "dashboard"];
        } 
        if ($redirectTo !== "") {
            return [
                "redirectTo" => $redirectTo,
                "name" => $name // Mengirim nama ke frontend
            ];
        } else {
            return ["Error" => "Format email tidak sesuai"];
        }
        
       
    }
}
