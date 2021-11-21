<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

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

    public function getImageAttribute($image) 
    {
        return config('global.imagesFullPath') . $image;
    }
}
