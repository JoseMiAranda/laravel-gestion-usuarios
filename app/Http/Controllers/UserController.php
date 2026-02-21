<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::get(['id', 'name', 'email', 'role']);
        return view('sections.index', compact('users'));
    }
}
