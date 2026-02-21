<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed:password_confirmation'],
        ]);
        $user = User::create($validated);
        Auth::login($user);
        return redirect('/');
    }
}
