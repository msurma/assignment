<?php

namespace App\Repository;

interface PostRepositoryInterface
{
    public function getPosts(int $page = 1, int $itemsPerPage = 5): array;

    public function getPostsCount(): int;
}