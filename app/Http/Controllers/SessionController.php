<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $validated = $request([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Credenciales no válidas',
            ]);
        }

        $request->session()->regenerate();
        return redirect('/');
    }

    public function destroy(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
