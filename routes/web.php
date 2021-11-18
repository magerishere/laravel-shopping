<?php

use App\Http\Resources\BlogResource;
use App\Models\Blog;
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
    $blog = Blog::find(1);
    $apiResource = BlogResource::class;
    return (new $apiResource($blog))->toArray($blog);
// echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>'; //insert jquery here
    
// $file = file_get_contents('https://ramzarz.news/mining-calculator/');

// echo $file;

// echo "<script>";
// echo "
// const wrapper = $('.wpb_wrapper')[1];
// $('body').html(wrapper);
// ";//jQuery script here
// echo "</script>";



    return bcrypt('password');
    DB::enableQueryLog();

    dump(DB::getQueryLog());
   return 'done';
});
