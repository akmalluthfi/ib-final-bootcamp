<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data)
    {
        $user = User::create($data);

        return $user;
    }
}
