<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);
 
        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'tipe' => 'karyawan'])) {
            $request->session()->regenerate();
 
            return redirect()->intended('/karyawan/tiket');
        }

        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'tipe' => 'admin'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/admin/home');
        }

        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'tipe' => 'teknisi'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/teknisi/tiket');
        }

        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'tipe' => 'pimpinan'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/pimpinan/home');
        }

        return back()->with([
            'loginError' => 'Login field!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
