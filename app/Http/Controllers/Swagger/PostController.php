<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Example for response examples value"
 * )
 *
 * @OA\PathItem(path="/api")
 */
class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Получить список всех постов",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ. Список постов.",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *                 type="object",
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Заголовок поста"),
     *                 @OA\Property(property="body", type="string", example="Текст поста"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="25 June 2024 12:34"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="25 June 2024 12:34")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован"
     *     )
     * )
     */
    public function index()
    {
        // code...
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Создать новый пост",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"title","body"},
     *
     *             @OA\Property(property="title", type="string", example="Новый пост"),
     *             @OA\Property(property="body", type="string", example="Текст нового поста")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Пост успешно создан",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="id", type="integer", example=2),
     *             @OA\Property(property="title", type="string", example="Новый пост"),
     *             @OA\Property(property="body", type="string", example="Текст нового поста"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="25 June 2024 12:34"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="25 June 2024 12:34")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован"
     *     )
     * )
     */
    public function store()
    {
        // code...
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{post}",
     *     summary="Получить один пост по ID",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ. Данные поста.",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Заголовок поста"),
     *             @OA\Property(property="body", type="string", example="Текст поста"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="25 June 2024 12:34"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="25 June 2024 12:34")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Пост не найден"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован"
     *     )
     * )
     */
    public function show()
    {
        // code...
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{post}",
     *     summary="Обновить пост по ID",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"title","body"},
     *
     *             @OA\Property(property="title", type="string", example="Обновленный заголовок"),
     *             @OA\Property(property="body", type="string", example="Обновленный текст поста")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Пост успешно обновлен",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Обновленный заголовок"),
     *             @OA\Property(property="body", type="string", example="Обновленный текст поста"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="25 June 2024 12:34"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="25 June 2024 13:00")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не найден"
     *     )
     * )
     */
    public function update()
    {
        // code...
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{post}",
     *     summary="Удалить пост по ID",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=204,
     *         description="Пост успешно удален"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не найден"
     *     )
     * )
     */
    public function destroy()
    {
        // code...
    }
}
