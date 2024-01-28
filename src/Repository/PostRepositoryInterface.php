<?php

namespace App\Repository;

use App\Entity\Post;

interface PostRepositoryInterface
{
    public function save(Post $post, bool $flush = false): void;

    public function getPosts(int $page = 1, int $itemsPerPage = 5): array;

    public function getPostsCount(): int;
}