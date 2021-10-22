<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface 
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }
        
    public function getPostsLastest()
    {
        return $this->model->orderBy('created_at','DESC')->take(5)->get(['id','user_id','title']);
    }

    public function getPosts()
    {
        $cols = ['id','title','is_active','publicted_at'];
        return $this->model->orderBy('id','DESC')->paginate(
            config('constants.paginate'),
            $columns = $cols
        );
    }
    public function find(Post $post)
    {
        return $this->model::find($post)->first();
    }
}
?>