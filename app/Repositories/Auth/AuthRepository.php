<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface {

    public function login(Request $request) : JsonResponse
    {
        try {
            $this->loginValidator($request);

            $credentials = $request->only('email','password');
            if(!Auth::attempt($credentials)) {
                return response()->json(['messages' => 'email or password incorrect']);
            }
            $user = Auth::user();
            $token = $user->createToken($user->id);

            return response()->json([
                'status' => 200,
                'userId' => $user->id,
                'token' => $token->accessToken
            ]);
            
        } catch(ValidationException $v) {
            return $this->errorsHandler($v);
         } catch(Exception $e) {
            return $this->errorsHandler($e);
            
        }
    }

    public function loginValidator(Request $request) : void
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function register(Request $request) : JsonResponse
    {
        try {

            $this->registerValidator($request);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            // auto login
            return $this->login($request);

        } catch(ValidationException $v) {
            return $this->errorsHandler($v);
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }


    public function registerValidator(Request $request) : void
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);
        if($validator->fails()) {
            throw new ValidationException($validator);
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