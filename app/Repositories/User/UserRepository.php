<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getAllUserWithPost()
    {
        return $this->model::withCount('posts')
                            ->orderBy('id','DESC')
                            ->paginate(config('constants.paginate'));
    }

    public function createUser(array $data)
    {
        try {
            return $this->model::create($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function findUserById($userId)
    {
        try {
            return $this->model::find($userId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getAdmin()
    {
        return $this->model->admin()->get();
    }
}
?>