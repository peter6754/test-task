<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    use AuthorizesRequests;

    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function addComment(StoreCommentRequest $request, Post $post)
    {
        $validated = $request->validated();

        $comment = $this->commentService->addCommentToPost(
            $post,
            $validated['body'],
            auth()->id()
        );

        return CommentResource::make($comment)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function updateComment(StoreCommentRequest $request, Post $post, $commentId)
    {
        $validated = $request->validated();

        $comment = Comment::where('post_id', $post->id)->findOrFail($commentId);

        $this->authorize('update', $comment);

        $updatedComment = $this->commentService->updateComment(
            $post,
            $commentId,
            $validated['body'],
            auth()->id()
        );

        return CommentResource::make($updatedComment)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function deleteComment(Post $post, $commentId)
    {
        $comment = Comment::where('post_id', $post->id)->findOrFail($commentId);

        $this->authorize('delete', $comment);

        $this->commentService->deleteComment(
            $post,
            $commentId,
            auth()->id()
        );

        return response()->json(['message' => 'Comment deleted successfully'], Response::HTTP_OK);
    }
}
