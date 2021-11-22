<?php

namespace App\Http\Controllers;

use App\Models\ProductMeta;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productRepository;
    
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->productRepository->all('products');
    }

    public function show($id)
    {
        return $this->productRepository->find('product',$id,[
            'meta',
            'user',
            'likes',
            'dislikes',
            'comments.user',
            'comments.likes',
            'comments.dislikes',
            'comments.replies',
            'comments.replies.user',
            'comments.replies.likes',
            'comments.replies.dislikes'
        ]);
    }

    public function userProducts()
    {
        return $this->productRepository->all('userProducts',[],true,true);
    }

    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        $catNames = json_decode($request->get('catNames'));
        $request['catNameKey'] = $catNames[0];
        $request['catName'] = $catNames[1];
        $city = json_decode($request->get('city')); // [021, 021 - تهران]
        $request['phone'] = $city[0] . '-' . $request->get('phone');
        $cityName = explode('-',$city[1])[1]; // [021,تهران]
        $request['city'] = trim($cityName);
        return $this->productRepository
                ->create(
                    $request->all(),
                    config('global.imagesBasePath'),
                    ['meta']
                );
    }

    public function edit($id)
    {
        return $this->productRepository->find('userProduct',$id,['meta'],false,true);
    }

    public function update(Request $request,$id)
    {
        $request['user_id'] = Auth::id();
        $catNames = json_decode($request->get('catNames'));
        $request['catNameKey'] = $catNames[0];
        $request['catName'] = $catNames[1];
        $city = json_decode($request->get('city')); // [021, 021 - تهران]
        $request['phone'] = $city[0] . '-' . $request->get('phone');
        $cityName = explode('-',$city[1])[1]; // [021,تهران]
        $request['city'] = trim($cityName);
        return $this->productRepository->update($request->all(),$id,config('global.imagesBasePath'),[ProductMeta::class]);
    }

    public function destroy(Request $request)
    {
        $ids = json_decode($request->get('ids'));
        return $this->productRepository->delete($ids);
    }
}
