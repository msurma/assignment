<?php

namespace App\Factory;

use App\Entity\Post;
use App\Repository\PostRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Post>
 *
 * @method        Post|Proxy                     create(array|callable $attributes = [])
 * @method static Post|Proxy                     createOne(array $attributes = [])
 * @method static Post|Proxy                     find(object|array|mixed $criteria)
 * @method static Post|Proxy                     findOrCreate(array $attributes)
 * @method static Post|Proxy                     first(string $sortedField = 'id')
 * @method static Post|Proxy                     last(string $sortedField = 'id')
 * @method static Post|Proxy                     random(array $attributes = [])
 * @method static Post|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PostRepository|RepositoryProxy repository()
 * @method static Post[]|Proxy[]                 all()
 * @method static Post[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Post[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Post[]|Proxy[]                 findBy(array $attributes)
 * @method static Post[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Post[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PostFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'content' => self::faker()->text(),
            'image' => ImageFactory::new(),
            'title' => self::faker()->text(80),
        ];
    }

    protected static function getClass(): string
    {
        return Post::class;
    }

    protected function initialize(): static
    {
        return $this->instantiateWith(
            function (array $attributes) {
                return Post::create(
                    $attributes['title'],
                    $attributes['content'],
                    $attributes['image']
                );
            }
        );
    }
}
