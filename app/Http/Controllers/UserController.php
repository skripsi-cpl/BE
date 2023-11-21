<?php

namespace App\Http\Controllers;
use App\Models\User;
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

        if ($domain === 'students.undip.ac.id') {
            return ["redirectTo" => "dashboardmhs"];
        } elseif ($domain === 'lecturer.undip.ac.id') {
            return ["redirectTo" => "dashboarddosen"];
        } elseif ($domain === 'departemen.undip.ac.id') {
            return ["redirectTo" => "dashboarddepartment"];
        } elseif ($domain === 'operator.undip.ac.id') {
            return ["redirectTo" => "dashboard"];
        }else {
            return ["Error" => "Format email tidak sesuai"];
        }
    }
}
