<?php

namespace Code16\JockoClient;

use Code16\JockoClient\Listeners\FetchCollections;
use Code16\JockoClient\Listeners\UpdateCollections;
use TightenCo\Jigsaw\Events\EventBus;

class Listeners
{
    public static function register(EventBus $events): void
    {
        $events->beforeBuild(FetchCollections::class);
        $events->afterCollections(UpdateCollections::class);
    }
}
