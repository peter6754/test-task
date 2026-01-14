<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoPostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\VideoPostResource;
use App\Models\VideoPost;
use Illuminate\Http\Request;

class VideoPostController extends Controller
{
    public function index()
    {
        $posts = VideoPost::all();

        return VideoPostResource::collection($posts);
    }

    public function store(StoreVideoPostRequest $request)
    {
        $post = VideoPost::create($request->validated());

        return VideoPostResource::make($post);
    }

    public function show(VideoPost $videoPost, Request $request)
    {
        $perPage = $request->query('per_page', 15);

        $comments = $videoPost->comments()
            ->cursorPaginate($perPage);

        return VideoPostResource::make($videoPost)->additional([
            'comments' => CommentResource::collection($comments),
            'comments_meta' => [
                'next_cursor' => $comments->nextCursor()?->encode(),
                'prev_cursor' => $comments->previousCursor()?->encode(),
                'per_page' => $comments->perPage(),
            ],
        ]);
    }
}
