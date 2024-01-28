<?php

namespace App\Service;

use App\Entity\Image;
use App\Repository\ImageRepositoryInterface;
use Doctrine\ORM\Exception\ORMException;

final class ImageService implements ImageServiceInterface
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository
    )
    {
    }

    public function getImageById(string $id): ?Image
    {
        return $this->imageRepository->find($id);
    }

    public function createImage(Image $image, bool $flush = false): bool
    {
        try {
            $this->imageRepository->save($image, $flush);

            return true;
        } catch (ORMException $e) {
            // todo: log exception
            return false;
        }
    }
}