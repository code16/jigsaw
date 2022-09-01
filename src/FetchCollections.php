<?php

namespace Code16\Novak;
use TightenCo\Jigsaw\Jigsaw;

class FetchCollections
{
    public function handle(Jigsaw $jigsaw)
    {
        $config = $jigsaw->getConfig('novak');
    
        $client = new Client($config['url'], $config['token']);
        $collections = $client->getCollections();
        
        foreach ($collections as $name => $collection) {
            $jigsaw->setConfig(
                "collections.$name.items",
                collect($collection->items)
                    ->map(fn ($item) => [
                        ...$item,
                        'filename' => $item['slug'],
                    ])
            );
        }
    }
}
