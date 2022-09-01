<?php

namespace Code16\JockoClient\Listeners;

use Code16\JockoClient\Page;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;
use TightenCo\Jigsaw\SiteData;

class UpdateCollections
{
    public function handle(Jigsaw $jigsaw)
    {
        /**
         * @var SiteData $collections
         */
        $collections = $jigsaw->getCollections();
        
        $collections->intersectByKeys($jigsaw->getConfig('collections'))
            ->each(function (PageVariable $collection) {
                $collection->transform(fn (CollectionItem $item) => Page::fromItem($item));
            });
    }
}
