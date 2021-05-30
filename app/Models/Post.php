<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'video','category_id', 'limits'];

    public function getImageAttribute()
    {
        return url('/storage/' . $this->video);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class)->where('isDislike', '=','0');
    }
    public function dislikes()
    {
        return $this->hasMany(Like::class)->where('isDislike', '=','1');
    }
}
