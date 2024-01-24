<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Response\PostResponse;
use App\Entity\Post;
use App\Service\BlogServiceInterface;

/**
 * @implements ProviderInterface<PostResponse>
 */
final class PostRepresentationProvider implements ProviderInterface
{
    public function __construct(
        private BlogServiceInterface $blogService,
    )
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?PostResponse
    {
        /** @var ?Post $post */
        $post = $this->blogService->getPostById($uriVariables['id']);

        if (!$post) {
            return null;
        }

        $response = new PostResponse();

        $response->title = $post->getTitle();
        $response->content = $post->getContent();
        $response->image = $post->getImage()->getPath();

        return $response;
    }
}