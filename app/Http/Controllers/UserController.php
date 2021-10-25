<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUserWithPost();

        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->all();
            $this->userService->createUser($data);
    
            return redirect()->route('users.index')->with('success','Add user successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
           return $this->userService->findUserById($user);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            $user = $this->userService->findUserById($user);

            return view('admin.user.edit',compact('user'));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->only('name','email');
            $this->userService->updateUser($data,$user);

            return redirect()->route('users.index')->with('success','Update User Successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $this->userService->deleteUser($user);

            return redirect()->back()->with('success','Delete User Successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
        } 
    }

    public function getAdmin()
    {
        try {
            $admins = $this->userService->getAdmin();
            
            return view('admin.dashboard',compact('admins'));
        } catch (\Throwable $th) {
        Log::error($th);
        }
    }
}
