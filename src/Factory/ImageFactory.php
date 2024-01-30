<?php

namespace App\Factory;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Image>
 *
 * @method        Image|Proxy                     create(array|callable $attributes = [])
 * @method static Image|Proxy                     createOne(array $attributes = [])
 * @method static Image|Proxy                     find(object|array|mixed $criteria)
 * @method static Image|Proxy                     findOrCreate(array $attributes)
 * @method static Image|Proxy                     first(string $sortedField = 'id')
 * @method static Image|Proxy                     last(string $sortedField = 'id')
 * @method static Image|Proxy                     random(array $attributes = [])
 * @method static Image|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ImageRepository|RepositoryProxy repository()
 * @method static Image[]|Proxy[]                 all()
 * @method static Image[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Image[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Image[]|Proxy[]                 findBy(array $attributes)
 * @method static Image[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Image[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ImageFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'path' => self::faker()->text(20) . '.png',
        ];
    }

    protected static function getClass(): string
    {
        return Image::class;
    }

    protected function initialize()
    {
        return $this->instantiateWith(
            function (array $attributes) {
                return Image::createWithPath($attributes['path']);
            }
        );
    }
}
