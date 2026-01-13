<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;

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

    public function show(News $news)
    {
        return NewsResource::make($news);
    }
}
