<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\ArrayPaginator;
use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\Pagination\TraversablePaginator;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Response\PostResponse;
use App\Mapper\PostMapper;
use App\Service\BlogServiceInterface;

/**
 * @implements ProviderInterface<PostResponse|PostResponse[]|null>
 */
final class PostListProvider implements ProviderInterface
{
    public function __construct(
        private BlogServiceInterface $blogService,
        private PostMapper $postMapper,
        private Pagination $pagination,
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PaginatorInterface
    {
        [$page, , $limit] = $this->pagination->getPagination($operation, $context);

        $posts = $this->blogService->getPosts($page, $limit);
        $postsCount = $this->blogService->getPostsCount();

        $response = new \ArrayIterator();
        foreach ($posts as $post) {
            $response->append($this->postMapper->mapPostToPostResponse($post));
        }

        return new TraversablePaginator($response, $page, $limit, $postsCount);
    }
}