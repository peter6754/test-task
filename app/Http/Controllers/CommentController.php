<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class CommentController extends Controller
{
    public function addComment(StoreCommentRequest $request, Post $post)
    {
        $validated = $request->validated();

        $comment = $post->comments()->create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
        ]);

        return CommentResource::make($comment);
    }
}
