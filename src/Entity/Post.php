<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post as PostOperation;
use App\Dto\Request\CreatePostRequest;
use App\Dto\Response\PostResponse;
use App\Repository\PostRepository;
use App\State\PostListProvider;
use App\State\PostProvider;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(operations: [
    new GetCollection(
        paginationItemsPerPage: 5,
        output: PostResponse::class,
        provider: PostListProvider::class,
    ),
    new Get(
        output: PostResponse::class,
        provider: PostProvider::class,
    ),
    new PostOperation(
        status: 202,
        input: CreatePostRequest::class,
        output: false,
        messenger: 'input',
    )
])]
class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private string $id;

    #[ORM\Column(length: 80)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $content;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Image $image;

    private function __construct()
    {
    }

    public static function create(
        string $title,
        string $content,
        Image $image
    )
    {
        $post = new self();

        $post->title = $title;
        $post->content = $content;
        $post->image = $image;

        return $post;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImage(): Image
    {
        return $this->image;
    }
}
