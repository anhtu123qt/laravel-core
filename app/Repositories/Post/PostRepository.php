<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }

    public function getPostsLastest()
    {
        return $this->model->orderBy('created_at', 'DESC')->take(5)->get(['id', 'user_id', 'title']);
    }

    public function getAllPosts()
    {
        return $this->model->orderBy('id', 'DESC')->paginate(config('constants.paginate')
        );
    }

    public function findPostById($userId)
    {
        try {
            return $this->model->find($userId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
