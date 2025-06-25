<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    public function addCommentToPost(Post $post, string $body, int $userId): Comment
    {
        return $post->comments()->create([
            'body' => $body,
            'user_id' => $userId,
        ]);
    }
}
