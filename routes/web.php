<?php

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Like;
use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Database\Eloquent\Relations\Relation;
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
    $like = new Like(['user_id'=> 1,'type' => 1]);
    $like['type'] = 0;
    return $like;
    $product = Product::findOrFail(1);
    // $like = new Like(['type' => 2,'user_id' => 1]);
    $alias =  $product->getMorphClass();
    return Relation::getMorphedModel($alias)::find(1);

    $product->likes[0]->type = 0;
    $product->push();
    return 'done';

 




    return bcrypt('password');
   
});
