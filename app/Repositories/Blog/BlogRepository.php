<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;


class BlogRepository extends BaseRepository implements BlogRepositoryInterface {
    protected $model = Blog::class;



}