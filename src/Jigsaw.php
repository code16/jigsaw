<?php

namespace Code16\Jigsaw;

use Code16\Jigsaw\Listeners\ClearCache;
use Code16\Jigsaw\Listeners\FetchCollections;
use Code16\Jigsaw\Listeners\FetchConfig;
use Code16\Jigsaw\Providers\BladeIconsServiceProvider;
use Code16\Jigsaw\Providers\CollectionServiceProvider;
use Code16\Jigsaw\Providers\MarkdownServiceProvider;
use Illuminate\Support\Facades\Facade;
use TightenCo\Jigsaw\Container;
use TightenCo\Jigsaw\Events\EventBus;

class Jigsaw
{
    public static function init(EventBus $events, Container $container): void
    {
        $events->beforeBuild(ClearCache::class);
        $events->beforeBuild(FetchCollections::class);
        $events->beforeBuild(FetchConfig::class);

        static::registerProviders($container, [
            MarkdownServiceProvider::class,
            BladeIconsServiceProvider::class,
            CollectionServiceProvider::class,
        ]);

        Facade::setFacadeApplication($container);
    }

    public static function registerProviders(Container $container, array $providers): void
    {
        foreach ($providers as $provider) {
            (new $provider($container))->register();
        }

        $container->booting(function () use ($providers, $container) {
            array_walk($providers, function ($provider, $container) {
                if (method_exists($provider, 'boot')) {
                    $container->call([$provider, 'boot']);
                }
            });
        });
    }
}
