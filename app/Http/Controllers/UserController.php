<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
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

        return view('admin.user.index', compact('users'));
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
            $this->userService->createUser($request->all());
    
            return redirect()->route('users.index')->with('success', 'Add user successfully!');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->userService->findUserById($id);
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->userService->findUserById($id);

            return view('admin.user.edit', compact('user'));
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->only('name', 'email');
            $this->userService->updateUser($data, $id);

            return redirect()->route('users.index')->with('success', 'Update User Successfully!');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userService->deleteUser($id);

            return redirect()->back()->with('success', 'Delete User Successfully!');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    public function getAdmin()
    {
        try {
            $admins = $this->userService->getAdmin();
            
            return view('admin.dashboard', compact('admins'));
        } catch (\Exception $e) {
            return abort(500);
        }
    }
}
