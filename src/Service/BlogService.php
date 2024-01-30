<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepositoryInterface;
use Doctrine\ORM\Exception\ORMException;

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

    public function createPost(Post $post, bool $flush = false): bool
    {
        try {
            $this->postRepository->save($post, $flush);

            // todo: emit event and register subscriber that sends email

            return true;
        } catch (ORMException $e) {
            // todo: log exception
            return false;
        }
    }
}