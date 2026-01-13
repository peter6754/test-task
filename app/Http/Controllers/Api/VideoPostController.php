<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoPostRequest;
use App\Http\Resources\VideoPostResource;
use App\Models\VideoPost;

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

    public function show(VideoPost $videoPost)
    {
        return VideoPostResource::make($videoPost);
    }
}
