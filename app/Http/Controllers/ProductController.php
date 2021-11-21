<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function userProducts()
    {
        Log::alert('yes');
        return $this->productRepository->all('userProducts',null,true,true);
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
        $request['city'] = $cityName;
        return $this->productRepository->create($request->all(),config('global.imagesBasePath'));
    }

    public function destroy(Request $request)
    {
        $ids = json_decode($request->get('ids'));
        return $this->productRepository->delete($ids);
    }
}
