<?php

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = User::find(1);
  $comments = Comment::with('user','likes','dislikes')->get();
    foreach($comments[0]->likes as $like) {
        if($like->user_id === $user->id && $like->type) {
            return 'liked';
        }
        if($like->user_id === $user->id && !$like->type) {
            return 'disliked';
        }
        return 'none';
    }
    // return $comments;
    // return view('welcome');
});
