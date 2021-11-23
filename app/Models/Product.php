<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{

    use HasFactory,HasLike;

    protected $fillable = [
        'user_id',
        'catNameKey',
        'catName',
        'title',
        'image',
        'amount',
        'qty',
        'content'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];



    public function getImageAttribute($image) 
    {
        return config('global.imagesFullPath') . $image;
    }

    public function meta()
    {
        return $this->hasOne(ProductMeta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

   
}
