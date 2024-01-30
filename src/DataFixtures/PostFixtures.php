<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $image = Image::createWithPath('image_' . mt_rand(0, 99999) . '.png');
            $manager->persist($image);

            $post = Post::create(
                'post title ' . mt_rand(100000, 999999),
                'lorem ipsum dolor sit amet ' . mt_rand(100000, 999999),
                $image
            );

            $manager->persist($post);
        }

        $manager->flush();
    }
}
