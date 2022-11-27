<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private UserRepository $userRepository;
    private $expiration;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        // Set jwt expiration times for refresh and (feature)remember
        $this->expiration = Auth::factory()->getTTL() * 24; // equal to 1 day
    }

    public function register($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->create($data);
        
        $auth['token'] = Auth::login($user);
        return $auth;
    }

    public function login($data)
    {
        $credentials = [
            'email' => $data['email'], 
            'password' => $data['password']
        ];

        if($data['remember'] ?? false)
        {
            $auth['exp'] = $this->expiration;
            Auth::factory()->setTTL($auth['exp']);
        }

        $auth['token'] = Auth::attempt($credentials);
        return $auth;
    }

    public function logout()
    {
        return Auth::logout();
    }

    public function refresh()
    {
        $auth['exp'] = $this->expiration;
        Auth::factory()->setTTL($auth['exp']);
        
        $auth['token'] = Auth::refresh();
        return $auth;
    }
}
