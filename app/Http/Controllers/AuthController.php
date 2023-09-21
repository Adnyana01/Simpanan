<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:7|max:18',
        ]);
        $masalah = [];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user()->name;

            return redirect()->intended('home')->with(['massage' => ['Selamat datang ' . ucwords($user)]]);
        } else {
            if (User::where('email', $request->email)->first() == null) {
                $masalah['email'] = "Email address tidak ada!";
            }
            if (User::where('email', $request->email)->first() != null && User::where('email', $request->email)->first()->password !== Hash::make($request->password)) {
                $masalah['password'] = "Password Salah!";
            }
            return redirect()->route('simpanan.login')->with(['masalah' => $masalah]);
        }
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('simpanan.login');
    }
}
