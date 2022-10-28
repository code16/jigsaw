<?php

namespace Code16\Jigsaw\View\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class Content extends Component
{
    public function __construct(
        public ?int $imageThumbnailWidth = null,
        public ?int $imageThumbnailHeight = null,
        public ?string $headingLevel = null,
    ) {
    }
    
    public function transform(string $content): string
    {
        $this->transformImages($content);
        $this->transformHeadings($content);
        
        return $content;
    }
    
    protected function transformImages(string &$content)
    {
        $content = preg_replace_callback(
            '/<p>\s*<img src="([^"]+)" alt="([^"]*)"[^>]*>\s*<\/p>/',
            function ($matches) {
                return Blade::render('<x-content-image :src="$src" :alt="$alt" />', ['src' => $matches[1], 'alt' => $matches[2]]);
            },
            $content
        );
    }
    
    protected function transformHeadings(&$content)
    {
        if ($this->headingLevel) {
            $level = $this->getHeadingLevel();
            $content = preg_replace_callback(
                "#(</?h)(\d)#",
                fn ($matches) => $matches[1] . ($level + $matches[2] - 1),
                $content
            );
        }
    }
    
    public function getHeadingLevel(): ?int
    {
        if(is_string($this->headingLevel)) {
            return (int)str_replace('h', '', $this->headingLevel);
        }
        
        return $this->headingLevel;
    }
    
    public function render()
    {
        return view('_components.content');
    }
}
