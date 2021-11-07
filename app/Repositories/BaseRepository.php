<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Support\Str;

class BaseRepository implements BaseRepositoryInterface {
    protected $model;
  
    public function all(string $keyData,array $relations = [],bool $isOwn = false) : JsonResponse
    {
        try {
            // just get all data for user
            if($isOwn) {
                return $this->successResponse([
                    $keyData => $this->model::with($relations)->where(config('global.isOwnKey'),Auth::id())->get()
                ]);
            }
            return $this->successResponse([$keyData => $this->model::with($relations)->get()]);
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function create(array $data,string $uploadBasePath) : JsonResponse
    {
        try {
            $data = $this->fileUploader($data,$uploadBasePath);
            $this->model::create($data);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorsHandler($e);
        }
    }

    public function update(array $data,$id,string $uploadBasePath) : JsonResponse
    {
        try {
            $this->model = $this->model::findOrFail($id);

            $data = $this->fileUploader($data,$uploadBasePath);
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


    public function find(string $keyData,$id,array $relations = null,bool $isOwn = false) : JsonResponse
    {
        try {
            $model = $this->model::findOrFail($id);
            // if isOwn set true,check if data blongs to user
            $isOwnKey = config('global.isOwnKey');
            if($isOwn && $model->$isOwnKey !== Auth::id()) {
                throw new UnauthorizedException();
                return null;
            }

            if($relations) {
                $model->load($relations);
            }

            return $this->successResponse([$keyData => $model]);
          
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


}