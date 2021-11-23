<?php

namespace App\Repositories\Like;

use App\Models\Blog;
use App\Models\Like;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface {
    public function like(string $type,$id) : JsonResponse
    {
        try {
            // likeable model
            $model = $this->determineType($type,$id);
            // liked by user
            $isLike = $model->currentLike();
            // if already liked by user
            if(!is_null($isLike)) {
                // delete like
                $isLike->delete();
            } else {
                // if dont liked,create new like
                $like = new Like(['user_id' => Auth::id(),'type' => 1]);
                $model->likes()->save($like);
                // if already have dislike, remove it
                $isDislike = $model->currentDislike();
                if(!is_null($isDislike)) {
                    $isDislike->delete();
                } 
            }
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function dislike(string $type,$id) : JsonResponse
    {
        try {
            // likeable model
            $model = $this->determineType($type,$id);
            // disliked by user
            $isDislike = $model->currentDislike();
            // if already disliked by user
            if(!is_null($isDislike)) {
                // delete dislike
                $isDislike->delete();
           
            } else {
                // if dont disliked,create new dislike
                $dislike = new Like(['user_id' => Auth::id(),'type' => 0]);
                $model->dislikes()->save($dislike);
                // if already have like, remove it
                $isLike = $model->currentLike();
                if(!is_null($isLike)) {
                    $isLike->delete();
                }
            }
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    private function determineType(string $type,$id) : Model
    {
        try { 
            switch($type) {
                case 'Product': 
                    return Product::findOrFail($id);
                    break;
                case 'Blog':
                    return Blog::findOrFail($id);
                    break;
                default: 
                  return throw new ModelNotFoundException();
            }
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }
} 