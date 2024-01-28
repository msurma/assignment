<?php

namespace App\Service;

use App\Entity\Image;

interface ImageServiceInterface
{
    public function getImageById(string $id): ?Image;

    public function createImage(Image $image, bool $flush = false): bool;
}