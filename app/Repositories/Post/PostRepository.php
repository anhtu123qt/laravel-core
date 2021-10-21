<?php
    namespace App\Repositories\Post;

    use App\Repositories\BaseRepository;

    class PostRepository extends BaseRepository implements PostRepositoryInterface 
    {
        public function getModel()
        {
            return \App\Models\Post::class;
        }
        public function getPostLastest()
        {
            return $this->model->orderBy('created_at','DESC')->take(5)->get(['id','user_id','title']);
        }
    }
?>