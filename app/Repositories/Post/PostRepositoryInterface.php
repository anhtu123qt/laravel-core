<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface 
{
    public function getPostsLastest();
        
    public function getPosts();

    public function find(Post $post);

    public function createPost(array $attrs);

    public function updatePost(array $attrs,$id);

}
    
?>