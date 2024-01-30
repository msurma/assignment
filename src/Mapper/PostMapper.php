<?php

namespace App\Mapper;

use App\ApiResource\PostApi;
use App\Dto\Request\CreatePostRequest;
use App\Entity\Image;
use App\Entity\Post;

final class PostMapper
{
    public function mapPostToPostApi(Post $post): PostApi
    {
        $postApi = new PostApi();

        $postApi->id = $post->getId();
        $postApi->title = $post->getTitle();
        $postApi->content = $post->getContent();
        $postApi->image = $post->getImage()->getPath();

        return $postApi;
    }

    public function mapCreatePostRequestToPost(CreatePostRequest $createPostRequest, Image $image)
    {
        return Post::create(
            $createPostRequest->title,
            $createPostRequest->content,
            $image
        );
    }
}