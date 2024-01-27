<?php

namespace App\Mapper;

use App\Dto\Response\PostResponse;
use App\Entity\Post;

final class PostMapper
{
    public function mapPostToPostResponse(Post $post): PostResponse
    {
        $postResponse = new PostResponse();

        $postResponse->id = $post->getId();
        $postResponse->title = $post->getTitle();
        $postResponse->content = $post->getContent();
        $postResponse->image = $post->getImage()->getPath();

        return $postResponse;
    }
}