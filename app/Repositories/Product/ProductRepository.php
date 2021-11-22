<?php

namespace App\Repositories\Product;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    protected $model = Product::class;
    protected $foreignKey = 'product_id';
    protected $apiResource = ProductResource::class;

}