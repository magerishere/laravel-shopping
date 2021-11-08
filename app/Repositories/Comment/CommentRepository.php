<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface {
    protected $model = Comment::class;

    public function like($id) : JsonResponse
    {
        try {
           $user = Auth::user();
           $user->comments()->syncWithoutDetaching([1 => ['type' => true]]);
           return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }
}