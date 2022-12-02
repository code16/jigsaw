<?php

namespace Code16\Jigsaw\Providers;

use Code16\Jigsaw\MarkdownParser;
use TightenCo\Jigsaw\Support\ServiceProvider;

class MarkdownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('markdownParser', fn () => new MarkdownParser());
    }
}
