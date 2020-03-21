<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

}
