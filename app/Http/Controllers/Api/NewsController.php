<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return NewsResource::collection($news);
    }

    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->validated());

        return NewsResource::make($news);
    }

    public function show(News $news, Request $request)
    {
        $perPage = $request->query('per_page', 15);

        $comments = $news->comments()
            ->cursorPaginate($perPage);

        return NewsResource::make($news)->additional([
            'comments' => CommentResource::collection($comments),
            'comments_meta' => [
                'next_cursor' => $comments->nextCursor()?->encode(),
                'prev_cursor' => $comments->previousCursor()?->encode(),
                'per_page' => $comments->perPage(),
            ],
        ]);
    }
}
