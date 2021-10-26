<?php

namespace App\Services;

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
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function findUserById($userId)
    {
        try {
            return $this->userRepo->findUserById($userId);          
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function updateUser(array $data, $userId)
    {
        try {
            $user = $this->userRepo->findUserById($userId);
            if ($user) {
                $user->update($data);

                return true;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function deleteUser($userId)
    {
        try {
            $user = $this->userRepo->findUserById($userId);
            if($user) {
                 $user->delete();

                 return true;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getAdmin()
    {
        return $this->userRepo->getAdmin();
    }
    public function getUserWithPost()
    {
        return $this->userRepo->getUserWithPost();
    }
}
?>