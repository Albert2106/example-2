<?php

namespace App\Repositories;

use App\Contracts\PostRepositoryInterface;
use App\DTOs\PostData;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostRepository implements PostRepositoryInterface
{
    private const SEARCH_LIMIT = 50;

    public function getPaginated(int $offset, int $limit): array
    {
        return $this->baseQuery()
            ->skip($offset)
            ->take($limit)
            ->get()
            ->map(fn(Post $post): PostData => PostData::fromModel($post))
            ->all();
    }

    public function search(string $query): array
    {
        $safe = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $query);

        return $this->baseQuery()
            ->where(fn(Builder $q) => $q
                ->where('name', 'like', "%{$safe}%")
                ->orWhere('description', 'like', "%{$safe}%")
            )
            ->take(self::SEARCH_LIMIT)
            ->get()
            ->map(fn(Post $post): PostData => PostData::fromModel($post))
            ->all();
    }

    public function getById(int $id): ?PostData
    {
        $post = Post::query()->published()->find($id);

        return $post ? PostData::fromModel($post) : null;
    }

    private function baseQuery(): Builder
    {
        return Post::query()
            ->published()
            ->orderByDesc('created_at');
    }
}
