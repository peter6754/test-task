<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content'];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
