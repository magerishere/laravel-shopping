<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface {
    protected $model = Blog::class;



    // public function show($id) : JsonResponse
    // {   
    //     try {
    //         $blog = $this->find($id);
    //     } catch (Exception $e) {
    //         return $this->errorsHandler($e);
    //     }
    // }

    // public function edit() 
    // {
    //     try {

    //     } catch (Exception $e) {
    //         return $this->errorsHandler($e);
    //     }
    // }
    
 

}