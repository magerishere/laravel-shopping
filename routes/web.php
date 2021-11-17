<?php

use App\Models\Blog;
use App\Models\Comment;
use App\Models\LikeDislikes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
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
    $contains = Str::contains('ThisisMyname', 'my');
    return $contains;
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
