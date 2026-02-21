<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index() {
        $users = User::get(['id', 'name', 'email', 'role']);
        return view('sections.index', compact('users'));
    }

    public function edit(Request $request, $id) {
        if (!Gate::authorize('update', [$request->user(), $id])) {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('sections.edit', compact('user'));
    }
}
