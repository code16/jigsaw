<?php

namespace Code16\Jigsaw;

use Code16\Jigsaw\Listeners\ClearCache;
use Code16\Jigsaw\Listeners\FetchCollections;
use Code16\Jigsaw\Listeners\FetchConfig;
use Code16\Jigsaw\View\Components\Svg;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Facade;
use Illuminate\View\Factory;
use TightenCo\Jigsaw\Events\EventBus;

class Jigsaw
{
    public static function init(EventBus $events, Container $container): void
    {
        $events->beforeBuild(ClearCache::class);
        $events->beforeBuild(FetchCollections::class);
        $events->beforeBuild(FetchConfig::class);
    
        Facade::setFacadeApplication($container);
    
        $container->bind('markdownParser', fn () => new MarkdownParser());
        $container->bind('blade.compiler', 'bladeCompiler');
        $container->bind(\Illuminate\Contracts\View\Factory::class, Factory::class);
        
        static::registerIcons($container);
    }
    
    protected static function registerIcons(Container $container): void
    {
        $filesystem = $container->make(Filesystem::class);
        $svgPath = $container['buildPath']['source'] . '/_assets/svg';
        $svg = [];
        
        if(!$filesystem->exists($svgPath)) {
            return;
        }
        
        foreach ($filesystem->allFiles($svgPath) as $file) {
            if ($file->getExtension() === 'svg') {
                $name = $file->getFilenameWithoutExtension();
                $container['blade.compiler']->component(Svg::class, $name, 'icon');
                $svg[$name] = $file->getContents();
            }
        }
        
        $container->instance('svg', $svg);
    }
}
