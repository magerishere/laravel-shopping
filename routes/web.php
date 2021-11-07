<?php

use App\Models\Blog;
use App\Models\User;
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
    $user = User::class;
    if($user->id) {
        return 'true';
    }
    return 'false';
    return Str::random(40);
    return public_path('storage') . '\\images';
    if(file_exists(public_path('storage/images/DgVb7jhcHiJB5ICIsDfqJ5KpL2j7mFavq3EImKws.png'))) {

        unlink(public_path('storage/images/DgVb7jhcHiJB5ICIsDfqJ5KpL2j7mFavq3EImKws.png'));
    }
    
    return 'done';
    return view('welcome');
});
