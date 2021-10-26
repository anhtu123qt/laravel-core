<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Post\PostRepositoryInterface;

class PostService 
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function getAllPosts()
    {
        return $this->postRepo->getAllPosts();
    }

    public function createPost(array $data, $user)
    {
        try {
            $image = $data['image'];
            if ($image) {
                $imageName = date("Y.m.d") . "." . $image->getClientOriginalName();
                Storage::disk(config('filesystems.default'))->putFileAs('upload/posts/' . $user->id, $image, $imageName);
                $data['image'] = $imageName;
            }
            $data['user_id'] = $user->id;
            $this->postRepo->create($data);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function findPostById($postId)
    {
        try {
            return $this->postRepo->findPostById($postId);
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function updatePost($data, $postId, $user)
    {
        try {
            $post = $this->postRepo->findPostById($postId);
            if ($post) {
                $image = $data['image'];
                if ($image) {
                    $imageName = date("Y.m.d") . "." . $image->getClientOriginalName();
                    Storage::disk(config('filesystems.default'))->putFileAs('upload/posts/' . $user->id, $image, $imageName);
                    $data['image'] = $imageName;
                }
                $data['user_id'] = $user->id;
                $post->update($data);
    
                return true;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function deletePost($postId)
    {
        try {
            $post = $this->postRepo->findPostById($postId);
            if ($post) {
                $post->delete();

                return true;
            }
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function activePost($postId)
    {
        try {
            $post = $this->postRepo->findPostById($postId);
           
            if ($post) {
                if ($post->is_active == Post::STATUS_INACTIVE) {
                    $post->is_active = Post::STATUS_ACTIVE;
                    $post->publicted_at = Carbon::now();
                } else {
                    $post->is_active = Post::STATUS_INACTIVE;
                    $post->publicted_at = null;
                }
                $post->save();

                return true;
            }
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
?>