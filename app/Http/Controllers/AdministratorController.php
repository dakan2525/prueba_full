<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function check(Request $request)
    {
        // dd($request);
        $request->validate([
            "email" => "required|email|exists:users,email",
            "password" => "required|min:8"
        ]);

        $credential = $request->only("email", "password");
        if (Auth::attempt($credential)) {

            if (Auth::user()->status === 'Inactivo') {
                Auth::logout();
                return redirect()->route("login")->with('fail', 'Usuario inactivo');
            }

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('fail', 'Las credenciales son incorrectas');
        }
    }

    public function login(Request $request)
    {

        if (Auth::guard('web')->check()) {
            return redirect()->route("dashboard");
        }

        return view("login");
    }

    public function dashboard()
    {
        return view("dashboard");
    }

    public function logout()
    {

        Auth::guard('web')->logout();
        return redirect()->route("login");
    }
}
