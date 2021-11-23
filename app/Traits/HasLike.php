<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

trait HasLike {
    public function likes()
    {
        return $this->morphMany(Like::class,'likeable')->where('type',1);
    }

    public function currentLike()
    {
        return $this->morphOne(Like::class,'likeable')->where([
            'user_id' => Auth::id(),
            'type' => 1
        ])->first();
    }
    
    public function dislikes()
    {
        return $this->morphMany(Like::class,'likeable')->where('type',0);
    }

    public function currentDislike()
    {
        return $this->morphOne(Like::class,'likeable')->where([
            'user_id' => Auth::id(),
            'type' => 0
        ])->first();
    }
}