<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'content'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($image)
    {
        return 'http://127.0.0.1:8000/storage/images/' . $image;
    }
}
