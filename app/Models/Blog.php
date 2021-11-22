<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'views',
        'catNameKey',
        'catName',
        'title',
        'image',
        'content',
    ];
    
    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
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
        return config('global.imagesFullPath') . $image;
    }

    public function getCatNamesAttribute()
    {
        return [$this->catNameKey,$this->catName];
    }
}
