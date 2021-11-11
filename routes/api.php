<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\UserController;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Passport Routes
|--------------------------------------------------------------------------
*/
Passport::routes();

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::post('/login', [Authcontroller::class , 'login']);
Route::post('/register', [AuthController::class , 'register']);
Route::post('/logout', [AuthController::class , 'logout'])->middleware('auth:api');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::get('/user/blogs', [UserController::class , 'blogs'])->middleware('auth:api');

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
*/
Route::get('/blogs',[BlogController::class , 'index']);
Route::post('/blogs',[BlogController::class , 'index']);
Route::get('/blog/{id}',[BlogController::class , 'show']);
Route::middleware('auth:api')->group(function() {
    Route::get('/blogs/user',[BlogController::class, 'userBlogs']);
    Route::post('/blog', [BlogController::class , 'store']);
    Route::get('/blog/user/{id}/edit', [BlogController::class , 'edit']);
    Route::patch('/blog/{id}', [BlogController::class,'update']);
    Route::post('/blog/{id}/{type}',[BlogController::class , 'likesAndDislikes']);
});

/*
|--------------------------------------------------------------------------
| Comment Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->group(function() {
    Route::post('/comment', [CommentController::class , 'store']);
    Route::post('/comment/{id}/{type}', [CommentController::class ,'likesAndDislikes']);
});

/*
|--------------------------------------------------------------------------
| Comment Reply Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->group(function() {
    Route::post('/comment-reply',[CommentReplyController::class , 'store']);
    Route::post('/comment-reply/{id}/{type}', [CommentReplyController::class , 'likesAndDislikes']);
});