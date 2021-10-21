<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function getAll()
    {
        // $users = User::all();
        // $users = User::with('posts')->get();
        $users = User::withCount('posts')->get();
        return view('admin.dashboard',compact('users'));
    }
}
