<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class VideoPost extends Model
{
    protected $fillable = ['title', 'video_url'];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
