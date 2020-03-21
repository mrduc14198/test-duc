<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($data)
    {
        return Auth::attempt($data);
    }

    public function update($data, $user)
    {
        try {
            $user = $this->userRepository->update( $user->id, [
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                ]
            );
            if (!empty($data['password'])){
                $user = $this->userRepository->update($user->id,[
                    'password' => Hash::make($data['password'])
                ]);
            }
            return $user;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return FALSE;
        }
    }

    public function customerRegister($data)
    {
        try {
            $user = $this->userRepository->create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return $user;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return FALSE;
        }

    }

    public function createSocialUser($user, $provider)
    {
        try {
            $createdUser = $this->userRepository->firstOrCreate(
                [
                    'email'             => $user->getEmail(),
                    'provider_id'       => $user->getId(),
                    'provider'          => $provider,
                ],
                [
                    'name'              => $user->getName(),
                    'remember_token'    => $user->token,
                ]
            );

            return $createdUser;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return FALSE;
        }
    }
}
