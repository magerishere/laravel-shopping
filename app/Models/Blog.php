<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'catName',
        'title',
        'image',
        'content',
        'views'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }

    public function likes()
    {
        return $this->hasMany(BlogLikes::class)->where('type',1);
    }

    public function dislikes()
    {
        return $this->hasMany(BlogLikes::class)->where('type',0);
    }

    public function getImageAttribute($image)
    {
        return 'http://127.0.0.1:8000/storage/images/' . $image;
    }
}
