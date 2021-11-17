<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface {

    public function login(Request $request) : JsonResponse
    {
        try {
          
            $credentials = $request->only('email','password');
            if(!Auth::attempt($credentials)) {
                return response()->json(['messages' => 'email or password incorrect']);
            }
            $user = Auth::user();
            $token = $user->createToken($user->id);

            return response()->json([
                'status' => 200,
                'userId' => $user->id,
                'token' => $token->accessToken,
                'userRole' => $user->role,
            ]);
            
         } catch(Exception $e) {
            return $this->errorsHandler($e);
        }
    }


    public function register(Request $request) : JsonResponse
    {
        try {
    
            $user = new User();
            $role = $request->role === 'false' ? 0 : 1;
            $user->role = $role;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            // auto login
            return $this->login($request);
            
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }


    public function logout(Request $request) : JsonResponse
    {
        try {
            $user = Auth::user();
            $user->tokens()->delete();
            return response()->json([
                'status' => 200,
                'userId' => null,
                'token' => null
            ]);
        } catch(Exception $e) {
            return $this->errorsHandler($e);
        }
    }

 
}