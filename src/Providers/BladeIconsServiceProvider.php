<?php

namespace Code16\Jigsaw\Providers;

use Code16\Jigsaw\View\Components\Svg;
use Illuminate\Filesystem\Filesystem;
use TightenCo\Jigsaw\Support\ServiceProvider;

class BladeIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $filesystem = $this->app[Filesystem::class];
        $svgPath = $this->app['buildPath']['source'] . '/_assets/svg';
        $svg = [];
    
        if(!$filesystem->exists($svgPath)) {
            return;
        }
    
        foreach ($filesystem->allFiles($svgPath) as $file) {
            if ($file->getExtension() === 'svg') {
                $name = $file->getFilenameWithoutExtension();
                $this->app['blade.compiler']->component(Svg::class, $name, 'icon');
                $svg[$name] = $file->getContents();
            }
        }
    
        $this->app->instance('svg', $svg);
    }
}
