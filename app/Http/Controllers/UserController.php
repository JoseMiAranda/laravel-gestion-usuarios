<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() {
        $users = User::get(['id', 'name', 'email', 'role']);
        return view('sections.index', compact('users'));
    }

    public function edit(Request $request, User $user) {
        return view('sections.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed:password_confirmation'],
        ]);
        $user->update($validated);
        return redirect('/users');
    }
}
