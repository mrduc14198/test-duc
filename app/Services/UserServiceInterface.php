<?php

namespace App\Services;

interface UserServiceInterface
{
    public function login($data);

    public function update($data, $user);

    public function createSocialUser($user, $provider);
}
