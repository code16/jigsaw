<?php

namespace Code16\Jigsaw\Providers;

use Code16\Jigsaw\CollectionPaginator;
use TightenCo\Jigsaw\Container;
use TightenCo\Jigsaw\Support\ServiceProvider;

class CollectionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\TightenCo\Jigsaw\Collection\CollectionPaginator::class, function (Container $app) {
            return new CollectionPaginator($app['outputPathResolver']);
        });
    }
}
