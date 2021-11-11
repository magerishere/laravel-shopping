<?php

namespace App\Repositories;

use Exception;
use Illuminate\Http\JsonResponse;

interface BaseRepositoryInterface {
    public function all(string $keyData, array $relations = null, bool $onlyCount = false, bool $isOwn = false) : JsonResponse;
    public function create(array $data,string $uploadBasePath = null) : JsonResponse;
    public function update(array $data,$id,string $uploadBasePath = null) : JsonResponse;
    public function fileUploader(array $data,string $uploadBasePath) : array;
    public function find(string $keyData ,$id,array $relations,bool $onlyCount = false, bool $isOwn = false) : JsonResponse;
    public function likesAndDislikesHandler($id,string $type) : JsonResponse;
    public function successResponse(array $data = []) : JsonResponse;
    public function errorsHandler(Exception $exception,array $errors) : JsonResponse;
}