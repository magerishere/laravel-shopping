<?php

namespace App\Repositories\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AuthRepositoryInterface {
    public function login(Request $request): JsonResponse;
    public function loginValidator(Request $request) : void;
    public function register(Request $request): JsonResponse;
    public function registerValidator(Request $request) : void;
    public function logout(Request $request): JsonResponse;
}