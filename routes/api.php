<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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
Route::get('/blogs/user',[BlogController::class, 'userBlogs'])->middleware('auth:api');
Route::post('/blog', [BlogController::class , 'store'])->middleware('auth:api');
Route::get('/blog/{id}',[BlogController::class , 'show']);
Route::get('/blog/user/{id}/edit', [BlogController::class , 'edit'])->middleware('auth:api');
Route::patch('/blog/{id}', [BlogController::class,'update'])->middleware('auth:api');
