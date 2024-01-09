<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    /*
    * @method POST
    */

    public function showFormRegistrasi()
    {
        return view('admin.tambahAdmin');
    }

    public function registrasi(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:akuns',
            'password' => 'required|min:6',
        ]);

        

        // Simpan data ke database menggunakan model Akun
        Akun::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('homeAdmin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function showFormLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        $akun = Akun::where('username', $request->username)->first();

        if ($akun && Hash::check($request->password, $akun->password)) {
            // Lakukan tindakan login, jika diperlukan
            return redirect()->route('homeAdmin');
        }

        return redirect()->route('akun.login')->with('error', 'Login gagal, Mohon periksa kembali username dan password anda.');
    }
}
