<?php

namespace App\DTOs;

use App\Models\Post;

final class PostData
{
    public function __construct(
        public readonly int    $id,
        public readonly string $title,
        public readonly string $excerpt,
        public readonly string $date,
    ) {}

    public static function fromModel(Post $post): self
    {
        return new self(
            id:      $post->id,
            title:   $post->name,
            excerpt: $post->description ?? '',
            date:    $post->created_at?->format('Y-m-d') ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,
            'date'    => $this->date,
        ];
    }
}
