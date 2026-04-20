<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate(); // ✅ keamanan

            $role = Auth::user()->role;

            // ✅ Redirect berdasarkan role
            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role == 'pimpinan') {
                return redirect('/pimpinan/dashboard');
            }

            return redirect('/karyawan/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // ✅ wajib untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}