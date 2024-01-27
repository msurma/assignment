<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepositoryInterface;

final class BlogService implements BlogServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    )
    {
    }

    public function getPostById(string $id): ?Post
    {
        return $this->postRepository->find($id);
    }

    public function getPosts(int $page = 1, int $itemsPerPage = 5): array
    {
        return $this->postRepository->getPosts($page, $itemsPerPage);
    }

    public function getPostsCount(): int
    {
        return $this->postRepository->getPostsCount();
    }
}