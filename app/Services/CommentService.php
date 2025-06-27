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

    public function updateComment(Post $post, int $commentId, string $body, int $userId): Comment
    {
        $comment = $post->comments()
            ->where('id', $commentId)
            ->where('user_id', $userId)
            ->firstOrFail();

        $comment->update([
            'body' => $body,
        ]);

        return $comment;
    }

    public function deleteComment(Post $post, int $commentId, int $userId): void
    {
        $comment = $post->comments()
            ->where('id', $commentId)
            ->where('user_id', $userId)
            ->firstOrFail();

        $comment->delete();
    }
}
