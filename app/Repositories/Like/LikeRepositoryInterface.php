<?php

namespace App\Repositories\Like;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\JsonResponse;

interface LikeRepositoryInterface extends BaseRepositoryInterface {
    public function like(string $type,$id) : JsonResponse;
    public function dislike(string $type,$id) : JsonResponse;
}