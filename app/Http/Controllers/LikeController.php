<?php

namespace App\Http\Controllers;

use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    private $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function like(string $type,$id)
    {
        return $this->likeRepository->like($type,$id);
    }

    public function dislike(string $type,$id)
    {
        return $this->likeRepository->dislike($type,$id);
    }
}
