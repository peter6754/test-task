<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Response;

class CommentController extends Controller
{
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
}
