<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'id_santri_fk' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            switch (Auth::user()->is_permission) {
                case 2:
                    return redirect()->route('parent.dashboard');
                case 3:
                    return redirect()->route('walas.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'id_santri_fk' => 'Anda tidak punya akses.',
                    ]);
            }
        }

        return back()->withErrors(['id_santri_fk' => 'Login gagal']);
    }
}
