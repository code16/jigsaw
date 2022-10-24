<?php

namespace Code16\Jigsaw;

use Code16\Jigsaw\Listeners\FetchCollections;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\View\Factory;
use TightenCo\Jigsaw\Events\EventBus;

class Jigsaw
{
    public static function init(EventBus $events, Container $container): void
    {
        $events->beforeBuild(FetchCollections::class);
    
        Facade::setFacadeApplication($container);
    
        $container->bind('markdownParser', fn () => new MarkdownParser());
        $container->bind('blade.compiler', 'bladeCompiler');
        $container->bind(\Illuminate\Contracts\View\Factory::class, Factory::class);
    }
}
