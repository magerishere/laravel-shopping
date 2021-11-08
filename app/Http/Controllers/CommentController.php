<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentStoreRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentStoreRequest $request)
    {
        $request['user_id'] = Auth::id();
        $request['blog_id'] = $request->blogId;
        return $this->commentRepository->create($request->all());
    }

    public function likesAndDislikes($id,$type)
    {
        if($type === 'like') {
            $type = true;
        }
        if($type === 'dislike') {
            $type = false;
        }

        return $this->commentRepository->likesAndDislikes($id,$type);
    }

    
}
