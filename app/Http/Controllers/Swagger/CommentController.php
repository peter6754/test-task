<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/posts/{post}/comments",
     *     summary="Добавить комментарий к посту",
     *     tags={"Comments"},
     *
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"body"},
     *
     *             @OA\Property(property="body", type="string", example="Отличная статья!")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Комментарий успешно добавлен",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="body", type="string", example="Отличная статья!"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-06-25T12:34:56Z")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     )
     * )
     */
    public function addComment()
    {
        // code
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{post}/comments/{comment}",
     *     summary="Обновить комментарий к посту",
     *     tags={"Comments"},
     *
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Parameter(
     *         name="comment",
     *         in="path",
     *         required=true,
     *         description="ID комментария",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"body"},
     *
     *             @OA\Property(property="body", type="string", example="Обновленный текст комментария")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Комментарий успешно обновлен",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="body", type="string", example="Обновленный текст комментария"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-06-27T12:34:56Z")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комментарий не найден"
     *     )
     * )
     */
    public function updateComment()
    {
        // code...
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{post}/comments/{comment}",
     *     summary="Удалить комментарий к посту",
     *     tags={"Comments"},
     *
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Parameter(
     *         name="comment",
     *         in="path",
     *         required=true,
     *         description="ID комментария",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Комментарий успешно удален",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Comment deleted successfully")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Комментарий не найден"
     *     )
     * )
     */
    public function deleteComment()
    {
        // code...
    }
}
