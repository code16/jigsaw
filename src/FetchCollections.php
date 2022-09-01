<?php

namespace Code16\JockoClient;

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
                        'filename' => $item['slug'] ?? $item['id'],
                    ])
            );
        }
    }
}
