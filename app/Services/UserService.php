<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUserWithPost()
    {
        return $this->userRepo->getAllUserWithPost();
    }

    public function createUser(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $this->userRepo->createUser($data);

            return true;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function findUserById(User $user)
    {
        try {
            $user = $this->userRepo->findUserById($user);

            return $user;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function updateUser(array $data, User $user)
    {
        try {
            $user = $this->userRepo->findUserById($user);
            if ($user) {
                $user->update($data);

                return $user;
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function deleteUser(User $user)
    {
        try {
            $user = $this->userRepo->findUserById($user);
            if($user) {
                 $user->delete();

                 return true;
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function getAdmin()
    {
        return $this->userRepo->getAdmin();
    }
}
?>