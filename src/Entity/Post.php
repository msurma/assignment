<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
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

    public const CONTENT_ALLOWED_TAGS = '<ul><li><ol><p><strong>';

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

        $post->title = strip_tags($title);
        $post->content = strip_tags($content, self::CONTENT_ALLOWED_TAGS);
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
