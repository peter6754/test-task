<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
