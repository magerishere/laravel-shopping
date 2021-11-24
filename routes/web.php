<?php

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Like;
use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Artisan;
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

    return  null;
   
});

Route::get('/storageLink', function() {
    Artisan::call('storage:link');
});
