<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

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
        return $this->model->orderBy('id','DESC')->paginate(
            config('constants.paginate')
        );
    }

    public function find(Post $post)
    {
        try {
            $post = $this->model::find($post)->first(); 

            return $post;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    public function createPost(array $attrs)
    {
        try {
            $user = auth()->user();
            $image = $attrs['image'];
            if($image) {
                $image_name = date("Y.m.d").".".$image->getClientOriginalName();
                Storage::disk(config('filesystems.default'))->putFileAs('upload/posts/'.$user->id,$image,$image_name);
                $attrs['image'] = $image_name;
            }
            $attrs['user_id'] = $user->id;
            $data = $this->model->create($attrs);

            return $data;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function updatePost(array $attrs,$id)
    {
        try {
            $post = $this->model->find($id);
            if($post) {
                $user = auth()->user();
                $image = $attrs['image'];
                if($image) {
                    $image_name = date("Y.m.d").".".$image->getClientOriginalName();
                    Storage::disk(config('filesystems.default'))->putFileAs('upload/posts/'.$user->id,$image,$image_name);
                    $attrs['image'] = $image_name;
                }
                $attrs['user_id'] = $user->id;
                $post->update($attrs);
    
                return true;
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
?>