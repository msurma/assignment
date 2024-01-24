<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;

final class BlogService implements BlogServiceInterface
{
    public function __construct(
        private PostRepository $postRepository
    )
    {
    }

    public function getPostById(string $id): ?Post
    {
        return $this->postRepository->find($id);
    }
}