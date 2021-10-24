<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $users = User::withCount('posts')->get();

        return view('admin.dashboard',compact('users'));
    }
    
    public function accessors($id)
    {
        $user = User::find($id);
        $user_upper = $user->name;

        return $user_upper;
    }
   
}
