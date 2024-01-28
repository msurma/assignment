<?php

namespace App\Service;

use App\Entity\Post;

interface BlogServiceInterface
{
    public function getPostById(string $id): ?Post;

    public function getPosts(int $page = 1, int $itemsPerPage = 5): array;

    public function getPostsCount(): int;

    public function createPost(Post $post, bool $flush = false): bool;
}