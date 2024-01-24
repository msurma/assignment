<?php

namespace App\Service;

use App\Entity\Post;

interface BlogServiceInterface
{
    public function getPostById(string $id): ?Post;
}