<?php

namespace Code16\Jigsaw\View\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class Content extends Component
{
    public function __construct(
        public ?int $imageThumbnailWidth = null,
        public ?int $imageThumbnailHeight = null,
    ) {
    }
    
    public function transform(string $content): string
    {
        $content = $this->transformImages($content);
        
        return $content;
    }
    
    public function transformImages(string $content): string
    {
        return preg_replace_callback(
            '/<p>\s*<img src="([^"]+)" alt="([^"]*)"[^>]*>\s*<\/p>/',
            function ($matches) {
                return Blade::render('<x-content-image :src="$src" :alt="$alt" />', ['src' => $matches[1], 'alt' => $matches[2]]);
            },
            $content
        );
    }
    
    public function render()
    {
        return view('_components.content');
    }
}
