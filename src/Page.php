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
    
    public function image(string $src): ?Image
    {
        return $src ? new Image($src) : null;
    }
    
    public static function fromItem(CollectionItem $item): static
    {
        $newItem = new static($item);
        $newItem->collection = $item->collection;
        $newItem->setContent($item->getContent());
        $newItem->_meta = $item->_meta;
        
        return $newItem;
    }
}
