<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $query = Comment::query();

        if (request()->has('commentable_type') && request()->has('commentable_id')) {
            $query->where([
                'commentable_type' => request('commentable_type'),
                'commentable_id' => request('commentable_id'),
            ]);
        }

        $comments = $query->get();

        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request)
    {
        if ($request->parent_id) {
            // Ответ на комментарий
            $parent = Comment::findOrFail($request->parent_id);
            $comment = $parent->answers()->create([
                'content' => $request->content,
                'user_id' => 1,
                'commentable_type' => $parent->commentable_type,
                'commentable_id' => $parent->commentable_id,
            ]);
        } else {
            // Комментарий к новости/видео
            $commentableType = $request->commentable_type;
            $commentable = $commentableType::findOrFail($request->commentable_id);
            $comment = $commentable->comments()->create([
                'content' => $request->content,
                'user_id' => 1,
            ]);
        }

        return CommentResource::make($comment);
    }

    public function show(Comment $comment)
    {
        return CommentResource::make($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return CommentResource::make($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(null, 204);
    }
}
