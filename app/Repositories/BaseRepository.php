<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Support\Str;

class BaseRepository implements BaseRepositoryInterface {
    protected $model;
  
    public function all(string $keyData, array $relations = null, bool $onlyCount = false, bool $isOwn = false) : JsonResponse
    {
        try {
            $model = $this->model::query();
            // load relations model
            if($relations) {
              $this->relationsLoader($model,$relations,$onlyCount);
            }
            // Get all data that belongs only to the user
            if($isOwn) {
                $isOwnKey = config('global.isOwnKey');
                $model->where($isOwnKey,Auth::id());
            }

            // Apply filters
            $request = request();
            if($catNames = $request->get('catNames')) {
                foreach(json_decode($catNames) as $catName) {
                    $model->orWhere('catNameKey',$catName);
                }
            }
            // Apply sorts
            $sort = $request->get('sort',config('global.orderByColumn')); 
            if($sort === 'desc' || $sort === 'asc') {
                $model->orderBy(config('global.orderByColumn'),$sort);
            } else {
                $model->orderByDesc($sort);
            }

            $model = $model->paginate(6);
          
            

            return $this->successResponse([$keyData => $model]);
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function create(array $data,string $uploadBasePath = null) : JsonResponse
    {
        try {
            if(!is_null($uploadBasePath)) {
                $data = $this->fileUploader($data,$uploadBasePath);
            }
            $model = $this->model::create($data);
            return $this->successResponse([

                'comment' => $model
            ]);
            // errors Handler
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function update(array $data,$id,string $uploadBasePath = null) : JsonResponse
    {
        try {
            $this->model = $this->model::findOrFail($id);
            if(!is_null($uploadBasePath)) {
                $data = $this->fileUploader($data,$uploadBasePath);
            }
            $this->model->update($data);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }
    
    public function fileUploader(array $data,string $uploadBasePath) : array
    {

        foreach($data as $key => $file) {
            if(request()->hasFile($key)) {
                // if want to update data
                if(request()->isMethod('PATCH') || request()->isMethod('PUT')) {
                    // remove old file before upload new file
                    $oldFilePath = $uploadBasePath . $this->model->getRawOriginal($key); 
                    if(file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $fileName = Str::random() . '.' . $file->extension();
                $file->move($uploadBasePath,$fileName);
                $data[$key] = $fileName;
            }
        }
        return $data;

    }


    public function find(string $keyData,$id,array $relations = null,bool $onlyCount = false,bool $isOwn = false) : JsonResponse
    {
        try {
            $model = $this->model::query();
            
            // load relations model
            if($relations) {
                $this->relationsLoader($model,$relations,$onlyCount);
            }
            $model = $model->findOrFail($id);
       
            // if isOwn set true,check if data blongs to user
            if($isOwn) {
                $this->mustBelongsToUser($model);
            }
        
            // increase views
            $this->viewsCounter($model);

            return $this->successResponse([$keyData => $model]);
          
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function delete(array $ids) : JsonResponse
    {
        try {
            foreach($ids as $id) {

                $model = $this->model::findOrFail($id);
                $model->delete();
            }
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function likesAndDislikesHandler($id,string $type) : JsonResponse
    {
        try {
            if($type === 'like') {
                $type = true;
            }
            if($type === 'dislike') {
                $type = false;
            }

           $user = Auth::user();
           // example: Comment -> CommentLikes
           $modelLikes = $this->model . 'Likes';
           // example: Comment -> comment
           $lowerCaseModelName = Str::lower(class_basename($this->model));
           // belongsToMany relations example: comment -> comments
           $relationName = Str::plural($lowerCaseModelName);
           // is own key in application is user_id
           $isOwnKey = config('global.isOwnKey');
           // foreign key model example: comment -> comment_id
           $foreignKey = $lowerCaseModelName . '_id';

            // if model have multi word example: CommentReply -> ['Comment','Reply']
            $seprateWords = seprateWords(class_basename($this->model));
            // if model have multi word
            if(count($seprateWords) > 0) {
                // lower case each item in array and put _ between
                // example: ['Comment','Reply'] -> comment_reply
                $lowerCaseSeprateWords = implode('_',array_map('strtolower',$seprateWords));
               
                $foreignKey = $lowerCaseSeprateWords . '_id';
                // example: comment_reply -> commentReply
                $lowerCaseRelationName = Str::camel($lowerCaseSeprateWords);
                // example: commentReply -> commentReplies
                $relationName = Str::plural($lowerCaseRelationName);
            }

           // check if user have like or dislike
           $likeOrDislikeExists = $modelLikes::where([
               $foreignKey => $id,
                $isOwnKey => $user->id,
                'type' => $type,
           ])->first();
           // if user have like or dislike
           if($likeOrDislikeExists) {
               // toggle like or dislike
               $user->$relationName()->toggle([$id => ['type' => $type]]);
           } else {
               // add like or dislike
               $user->$relationName()->syncWithoutDetaching([$id => ['type' => $type]]);
            }
           return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function successResponse(array $data = []) : JsonResponse
    {
        $data['status'] = 200;
        return response()->json($data);
    }
    public function errorsHandler(Exception $exception = null,array $errors = []) : JsonResponse
    {
        if($exception) {
  
            // Default error message
            if($exception instanceof Exception) {
                $errors['messages'] = __('messages.Exception');
            }
            // Query error message
            if($exception instanceof QueryException) {
                $errors['messages'] = __('messages.QueryException');
            }

            // Validation error message
            // This type of error message handle in 
            // Illuminate\Foundation\Exceptions\Handler.php in line 351
     
            // Unauthorized error message
            if($exception instanceof UnauthorizedException) {
                $errors['messages'] = __('messages.UnauthorizedException');
            }
            // Model not found error message
            if($exception instanceof ModelNotFoundException) {
                $errors['messages'] = __('messages.ModelNotFoundException');
            }
            Log::alert($exception->getMessage());
        }
        
        return response()->json($errors);


    }

    private function viewsCounter(Model $model)
    {   
        if(!is_null($model->views)) {
            $model->update([
                'views' => $model->views + 1
            ]);
        }
    }

    private function mustBelongsToUser(Model $model)
    {
        $isOwnKey = config('global.isOwnKey');
        if($model->$isOwnKey !== Auth::id()) {
            throw new UnauthorizedException();
        }
    }

    private function relationsLoader($model,array $relations,bool $onlyCount = false)
    {
        if($onlyCount) {
            $model->withCount($relations);
        } else {
          $model->with($relations);
        }
    }


}