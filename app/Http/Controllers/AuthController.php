<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private $authRepository;
    
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {
       return $this->authRepository->login($request);
    }

    public function register(RegisterRequest $request)
    {
        return $this->authRepository->register($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepository->logout($request);
    }

    
}
