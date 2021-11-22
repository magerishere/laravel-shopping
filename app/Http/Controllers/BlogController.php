<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    private $blogRepository;
   
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index() 
    {
        return $this->blogRepository->all('blogs',['comments','likes'],true);
    }

    public function userBlogs() 
    {
        Log::alert('header');
        Log::alert(request()->header('Authorization'));
        return $this->blogRepository->all('userBlogs',[],false,true);
    }


    public function store(BlogStoreRequest $request)
    {
        $request['user_id'] = Auth::id();
        $catNames = json_decode($request->get('catNames'));
        $request['catNameKey'] = $catNames[0];
        $request['catName'] = $catNames[1];
        $request['views'] = config('global.viewsCount');
        return $this->blogRepository->create($request->all(),config('global.imagesBasePath'));
    }

    public function show($id)
    {
        return $this->blogRepository->find('blog',$id,[
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

    public function edit($id) 
    {
        return $this->blogRepository->find('userBlog',$id,[],false,true);
    }

    public function update(BlogUpdateRequest $request,$id)
    {
        $catNames = json_decode($request->get('catNames'));
        $request['catNameKey'] = $catNames[0];
        $request['catName'] = $catNames[1];
        return $this->blogRepository
                    ->update($request->all(),$id,config('global.imagesBasePath'));
    }

    public function likesAndDislikes($id,string $type)
    {
        return $this->blogRepository->likesAndDislikesHandler($id,$type);
    }

    public function destroy(Request $request)
    {
        $ids = json_decode($request->get('ids'));
        return $this->blogRepository->delete($ids);
    }


}
