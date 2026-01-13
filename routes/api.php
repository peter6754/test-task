<?php

use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\VideoPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('news', NewsController::class)->only(['index', 'store', 'show']);

Route::apiResource('video-posts', VideoPostController::class)->only(['index', 'store', 'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
