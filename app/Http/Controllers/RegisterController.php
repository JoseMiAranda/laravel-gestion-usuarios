<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create() {
        $roles = Role::cases();
        return view('auth.register', compact('roles'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed:password_confirmation'],
            'role' => ['required', Rule::enum(Role::class)]
        ]);
        $user = User::create($validated);
        Auth::login($user);
        return redirect('/');
    }
}
