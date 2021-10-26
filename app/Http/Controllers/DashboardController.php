<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class DashboardController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function dashboard()
    {
        try {
            $admins = $this->userService->getAdmin();
            $users = $this->userService->getUserWithPost();
           
            return view('admin.dashboard', compact('admins', 'users'));
        } catch (\Exception $e) {
            return abort(500);
        }
    }
}
