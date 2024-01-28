<?php

namespace App\Handler;

use App\Dto\Request\CreatePostRequest;
use App\Mapper\PostMapper;
use App\Service\BlogServiceInterface;
use App\Service\ImageServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;

#[AsMessageHandler]
final class CreatePostHandler
{
    public function __construct(
        private BlogServiceInterface $blogService,
        private ImageServiceInterface $imageService,
        private PostMapper $postMapper,
    )
    {
    }

    public function __invoke(CreatePostRequest $createPostRequest)
    {
        $image = $this->imageService->getImageById($createPostRequest->imageId);

        if (!$image) {
            throw new UnrecoverableMessageHandlingException('Image with id [' . $createPostRequest->imageId . '] was not found');
        }

        $post = $this->postMapper->mapCreatePostRequestToPost($createPostRequest, $image);

        $this->blogService->createPost($post, flush: true);
    }
}