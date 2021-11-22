<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentStoreRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentStoreRequest $request)
    {
        Log::alert($request->all());
        $request['user_id'] = Auth::id();
        $request['commentable_type'] = $request->get('commentableType');
        $request['commentable_id'] = $request->get('commentableId');
        return $this->commentRepository->create($request->all());
    }

    public function likesAndDislikes($id,string $type)
    {
        return $this->commentRepository->likesAndDislikesHandler($id,$type);
    }

    
}
