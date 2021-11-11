<?php

namespace App\Repositories\CommentReply;

use App\Models\CommentReply;
use App\Repositories\BaseRepository;

class CommentReplyRepository extends BaseRepository implements CommentReplyRepositoryInterface {
    protected $model = CommentReply::class;
}