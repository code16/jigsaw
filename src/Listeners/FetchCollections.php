<?php

namespace Code16\JockoClient\Listeners;

use Code16\JockoClient\Client;
use TightenCo\Jigsaw\Jigsaw;

class FetchCollections
{
    public function handle(Jigsaw $jigsaw)
    {
        $config = $jigsaw->getConfig('jocko_api');
    
        $client = new Client($config['url'], $config['token']);
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
