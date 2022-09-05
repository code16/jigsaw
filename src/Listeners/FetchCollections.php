<?php

namespace Code16\Jigsaw\Listeners;

use Code16\Jigsaw\JockoClient;
use TightenCo\Jigsaw\Jigsaw;

class FetchCollections
{
    public function handle(Jigsaw $jigsaw)
    {
        $config = $jigsaw->getConfig('jocko_api');
    
        $client = new JockoClient($config['url'], $config['token']);
        $collections = $client->getCollections();
        
        foreach ($collections as $name => $collection) {
            $jigsaw->setConfig(
                "collections.$name.items",
                collect($collection['items'])
                    ->map(fn ($item) => [
                        ...$item,
                        'filename' => $item['key'] ?? $item['slug'] ?? $item['id'],
                    ])
            );
        }
    }
}
