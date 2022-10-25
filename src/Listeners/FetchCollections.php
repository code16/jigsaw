<?php

namespace Code16\Jigsaw\Listeners;

use Code16\Jigsaw\Jocko;
use Code16\Jigsaw\Page;
use TightenCo\Jigsaw\Jigsaw;

class FetchCollections
{
    public function handle(Jigsaw $jigsaw)
    {
        $jocko = new Jocko($jigsaw);
        $collections = $jocko->getCollections();
        
        foreach ($jigsaw->getConfig('collections') as $key => $collectionConfig) {
            $collectionKey = $collectionConfig['collectionKey'] ?? $key;
            if($collection = $collections[$collectionKey] ?? null) {
                $jigsaw->setConfig(
                    "collections.$key.items",
                    collect($collection['items'])
                        ->map(fn ($item, $i) => array_merge($item, [
                            'filename' => $item['key'] ?? $item['slug'] ?? $item['id'],
                            'index' => $i,
                        ]))
                );
    
                $jigsaw->setConfig("collections.$key.map", fn ($item) => Page::fromItem($item));
    
                if (! $jigsaw->getConfig("collections.$key.sort")) {
                    $jigsaw->setConfig("collections.$key.sort", 'index');
                }
            }
        }
    }
}
