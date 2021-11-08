<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\CommentLikes;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface {
    protected $model = Comment::class;

    public function likesAndDislikes($id,bool $type) : JsonResponse
    {
        try {
           $user = Auth::user();
           $likeOrDislikeExists = CommentLikes::where([
               'comment_id'=> $id,
                'user_id' => $user->id,
                'type' => $type,
           ])->first();
           if($likeOrDislikeExists) {
               $user->comments()->toggle([$id => ['type' => $type]]);
           } else {
               $user->comments()->syncWithoutDetaching([$id => ['type' => $type]]);
            }
           return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

}