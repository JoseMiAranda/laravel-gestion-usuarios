<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
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

    public function create() {
        $roles = Role::cases();
        return view('sections.create', compact('roles'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed:password_confirmation'],
            'role' => ['required', Rule::enum(Role::class)]
        ]);
        User::create($validated);
        return redirect('/users');
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed:password_confirmation'],
        ]);
        $user->update($validated);
        if($request->user()->can('is-admin')) return redirect('/users');
        return redirect('/');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect('/users');
    }
}
