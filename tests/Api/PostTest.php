<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\ImageFactory;
use App\Factory\PostFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class PostTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    public function testGetCollection(): void
    {
        PostFactory::createMany(100);

        $response = static::createClient()->request('GET', '/api/posts');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/Post',
            '@id' => '/api/posts',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 100,
            'hydra:view' => [
                '@id' => '/api/posts?page=1',
                '@type' => 'hydra:PartialCollectionView',
                'hydra:first' => '/api/posts?page=1',
                'hydra:last' => '/api/posts?page=20',
                'hydra:next' => '/api/posts?page=2',
            ],
        ]);

        $this->assertCount(5, $response->toArray()['hydra:member']);
    }

    public function testCreatePost(): void
    {
        $image = ImageFactory::createOne();

        static::createClient()->request(
            'POST', '/api/posts',
            [
                'json' => [
                    'title' => 'lorem ipsum dolor sit amet', // todo: use faker
                    'content' => 'lorem ipsum dolor sit amet lorem ipsum dolor sit amet',
                    'imageId' => $image->getId(),
                ],
                'headers' => [
                    'content-type' => 'application/ld+json',
                ]
            ]
        );

        $this->assertResponseStatusCodeSame(202);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testCreateInvalidPostWithHtmlTagsInTitle(): void
    {
        $image = ImageFactory::createOne();

        static::createClient()->request(
            'POST', '/api/posts',
            [
                'json' => [
                    'title' => '<b><b><b><br><br><br><br>asd<br>',
                    'content' => '<b><b><b><br><br><br><br>asd<br>',
                    'imageId' => $image->getId(),
                ],
                'headers' => [
                    'content-type' => 'application/ld+json; charset=utf-8',
                ]
            ]
        );

        $this->assertResponseStatusCodeSame(422);

        $this->assertJsonContains([
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'title: This value is too short. It should have 10 characters or more.
content: This value is too short. It should have 20 characters or more.',
        ]);
    }
}