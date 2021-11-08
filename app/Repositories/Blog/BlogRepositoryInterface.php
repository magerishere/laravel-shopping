<?php

namespace App\Repositories\Blog;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\JsonResponse;

interface BlogRepositoryInterface extends BaseRepositoryInterface {

    public function likesAndDislikes($id,bool $type) : JsonResponse;
}