<?php

namespace App\Story;

use App\Factory\PostFactory;
use Zenstruck\Foundry\Story;

final class DefaultPostsStory extends Story
{
    public function build(): void
    {
        PostFactory::createMany(50);
    }
}
