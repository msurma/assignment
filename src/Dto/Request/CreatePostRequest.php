<?php

namespace App\Dto\Request;

final class CreatePostRequest
{
    public string $title;
    public string $content;
    public string $imageId;
}