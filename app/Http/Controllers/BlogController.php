<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    private $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index() 
    {
        return $this->blogRepository->all('blogs');
    }

    public function userBlogs() 
    {
        return $this->blogRepository->all('userBlogs',[],true);
    }


    public function store(BlogStoreRequest $request)
    {
        $request['user_id'] = Auth::id();
        return $this->blogRepository->create($request->all(),config('global.imagesBasePath'));
    }

    public function show($id)
    {
        return $this->blogRepository->find('blog',$id,[
            'user',
            'comments.user',
            'comments.likes',
            'comments.dislikes'
        ]);
    }

    public function edit($id) 
    {
        return $this->blogRepository->find('blog',$id,[],true);
    }

    public function update(BlogUpdateRequest $request,$id)
    {
        
        return $this->blogRepository
                    ->update($request->all(),$id,config('global.imagesBasePath'));
    }


}
