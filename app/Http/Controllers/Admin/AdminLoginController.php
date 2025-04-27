<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Tampilkan form login admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba login menggunakan guard default
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended('/admin/dashboard');
        }

        // Jika gagal, redirect kembali ke form dengan error
        return redirect()->back()->withInput($request->only('email', 'remember'))
                         ->with('error', 'Email atau password salah.');
    }
}
