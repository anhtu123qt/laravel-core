<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface 
{
    public function getPostsLastest();
        
    public function getAllPosts();

    public function findPostById($postId);
}
    
?>