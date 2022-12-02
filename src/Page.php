<?php

namespace Code16\Jigsaw;

use TightenCo\Jigsaw\Collection\CollectionItem;

class Page extends CollectionItem
{
    public ?string $title;
    public ?Image $cover;
    
    public function __construct($items = [])
    {
        parent::__construct($items);
        
        $this->title = $this->get('title');
        $this->cover = $this->get('cover') ? new Image($this->get('cover')) : null;
    }
    
    public function getUrl($key = null)
    {
        return app(UrlGenerator::class)->to($this->getPath($key));
    }
    
    public function image(string $src): ?Image
    {
        return $src ? new Image($src) : null;
    }
}
