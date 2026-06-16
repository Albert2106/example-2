<?php

namespace App\Contracts;

use App\DTOs\PostData;

interface PostRepositoryInterface
{
    /** @return PostData[] */
    public function getPaginated(int $offset, int $limit): array;

    /** @return PostData[] */
    public function search(string $query): array;

    public function getById(int $id): ?PostData;
}
