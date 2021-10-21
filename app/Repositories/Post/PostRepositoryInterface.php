<?php
    namespace App\Repositories\Post;

    use App\Repositories\RepositoryInterface;

    interface PostRepositoryInterface extends RepositoryInterface 
    {
        public function getPostLastest();
        
        public function getPost();

    }
    
?>