<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\PostApi;
use App\Mapper\PostMapper;
use App\Service\BlogServiceInterface;

/**
 * @implements ProviderInterface<PostApi|PostApi[]|null>
 */
final class PostProvider implements ProviderInterface
{
    public function __construct(
        private BlogServiceInterface $blogService,
        private PostMapper $postMapper,
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): PostApi|array|null
    {
        $post = $this->blogService->getPostById($uriVariables['id']);

        if (!$post) {
            return null;
        }

        return $this->postMapper->mapPostToPostApi($post);
    }
}