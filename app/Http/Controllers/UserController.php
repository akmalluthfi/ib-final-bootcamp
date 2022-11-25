<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $auth = $this->userService->register($data);
        return new UserResource(auth()->user(), 'Registered new user successfully', $auth);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $auth = $this->userService->login($data);
        if(!$auth['token']){
            throw new AuthenticationException();
        }

        return new UserResource(auth()->user(), 'Logged in successfully', $auth);
    }

    public function logout()
    {
        $this->userService->logout();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function refresh()
    {
        $auth = $this->userService->refresh();

        return new userResource(auth()->user(), 'Refreshed authentication token successfully', $auth);
    }
}
