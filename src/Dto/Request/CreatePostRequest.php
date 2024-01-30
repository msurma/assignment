<?php

namespace App\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class CreatePostRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 80, normalizer: 'strip_tags')]
    public string $title;

    #[Assert\NotBlank]
    #[Assert\Length(min: 20, normalizer: 'strip_tags')]
    public string $content;

    // todo: check if image exists
    #[Assert\NotBlank]
    public string $imageId;
}