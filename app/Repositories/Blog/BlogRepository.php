<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface {
    protected $model = Blog::class;

    public function likesAndDislikes($id,bool $type) : JsonResponse
    {
        try {
            // $likeOrDislikesExists = 
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

}