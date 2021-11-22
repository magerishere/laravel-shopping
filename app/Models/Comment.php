<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'body',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->hasMany(CommentLikes::class)->where('type',1);
    }

    public function dislikes()
    {
        return $this->hasMany(CommentLikes::class)->where('type',0);
    }

    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }

   
}
