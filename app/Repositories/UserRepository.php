<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * The model instance
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * Create a new NewsRepository instance.
     * @param  \App\Models\user $user
     */
    public function __construct(User $user) 
    {
        $this->model = $user;
    }
}

