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
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function findUserById(User $user)
    {
        try {
            $user = $this->model::find($user)->first();

            return $user;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function getAdmin()
    {
        return $this->model->admin()->get();
    }
}
?>