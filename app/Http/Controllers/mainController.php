<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mainController extends Controller
{
    public static function halamanLogin(){
        return view('auth.login');
    }
    public static function profileIndex(){
        return view('profileSekolah.index');
    }
    public static function prosesLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/administrasi-guru');
        };
    }
}
