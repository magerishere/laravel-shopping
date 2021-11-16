<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Models\Blog;
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
        return $this->blogRepository->all('userBlogs',[],false,true);
    }


    public function store(BlogStoreRequest $request)
    {
        $request['user_id'] = Auth::id();
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
        return $this->blogRepository->find('blog',$id,[],false,true);
    }

    public function update(BlogUpdateRequest $request,$id)
    {
        return $this->blogRepository
                    ->update($request->all(),$id,config('global.imagesBasePath'));
    }

    public function likesAndDislikes($id,string $type)
    {
        return $this->blogRepository->likesAndDislikesHandler($id,$type);
    }

    public function destroy(Request $request)
    {
        Log::alert($request->all());
        $ids = $request->get('blogIds');
        return $this->blogRepository->delete($ids);
    }


}
