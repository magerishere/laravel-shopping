<?php

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Product;
use App\Models\ProductMeta;
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
    // $product = Product::findOrFail(54);
    $data = [
        'catNames' => 'something',
        'product_id' => 3,
        'phone' => '021-55667723',
        'address' => 'تهران، منطقه 17 خیابان شهید برادران حسنی،خیابان ابوذر،میدان مقدم،خیابان شهسوار جنوبی،کوچه طحان،پلاک 36،واحد 8',
        'city' => 'yes',
    ];
    $meta = ProductMeta::class;
    $meta = $meta::where('product_id',55)->first();
    $meta->update($data);

    return $meta;

 




    return bcrypt('password');
   
});
