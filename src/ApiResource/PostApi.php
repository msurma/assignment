<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Dto\Request\CreatePostRequest;
use App\State\PostListProvider;
use App\State\PostProvider;

#[ApiResource(
    shortName: 'Post',
    operations: [
    new GetCollection(
        paginationItemsPerPage: 5,
        provider: PostListProvider::class,
    ),
    new Get(
        provider: PostProvider::class,
    ),
    new Post(
        status: 202,
        input: CreatePostRequest::class,
        output: false,
        messenger: 'input',
    )
])]
final class PostApi
{
    public string $id;
    public string $title;
    public string $content;
    public string $image;
}