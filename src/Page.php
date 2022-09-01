<?php

namespace Code16\JockoClient;

use TightenCo\Jigsaw\Collection\CollectionItem;

class Page extends CollectionItem
{
    public ?Image $cover;
    
    public function __construct($items = [])
    {
        parent::__construct($items);
        
        $this->cover = $this->get('cover') ? new Image($this->get('cover')) : null;
    }
    
    public static function fromItem(CollectionItem $item)
    {
        $newItem = new static($item);
        $newItem->collection = $item->collection;
        $newItem->_content = $item->_content;
        $newItem->_meta = $item->_meta;
        
        return $newItem;
    }
}
