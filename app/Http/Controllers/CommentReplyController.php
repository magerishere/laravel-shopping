<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentReply\CommentReplyStoreRequest;
use App\Repositories\CommentReply\CommentReplyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentReplyController extends Controller
{
    private $commentReplyRepository;

    public function __construct(CommentReplyRepositoryInterface $commentReplyRepository)
    {
        $this->commentReplyRepository = $commentReplyRepository;
    }

    public function store(CommentReplyStoreRequest $request)
    {
        $request['user_id'] = Auth::id();
        $request['comment_id'] = $request->commentId;
        return $this->commentReplyRepository->create($request->all());
    }

    public function likesAndDislikes($id,string $type)
    {
        return $this->commentReplyRepository->likesAndDislikesHandler($id,$type);
    }
}
