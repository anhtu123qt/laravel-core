<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface 
{
    public function getAllUserWithPost();

    public function createUser(array $data);
    
    public function findUserById(User $user);

    public function getAdmin();
}
?>