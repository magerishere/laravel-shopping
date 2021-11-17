<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store(Request $request)
    {
        return $this->productRepository->create($request->all());
    }
}
