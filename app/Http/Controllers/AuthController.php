<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function welcome() {
        return view('welcome');
    }

    public function login() {
        return view('login');
    }

    public function dologin(Request $request) {
        // validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user admin
                return redirect()->intended('/admin/beranda');
            } else {
                // jika user user
                return redirect()->intended('/user/beranda');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}