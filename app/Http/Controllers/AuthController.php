<?php

namespace App\Http\Controllers;


use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authRepository;
    
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
       return $this->authRepository->login($request);
    }

    public function register(Request $request)
    {
        return $this->authRepository->register($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepository->logout($request);
    }

    
}
