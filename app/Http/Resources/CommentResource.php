<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'post' => $this->post->title,
            'user' => $this->user->name,
            'created_at' => $this->created_at ? $this->created_at->translatedFormat('d F Y H:i') : null,
        ];
    }
}
