<?php

namespace Code16\Novak;
use GuzzleHttp\Client;
use TightenCo\Jigsaw\Jigsaw;

class FetchCollections
{
    public function handle(Jigsaw $jigsaw)
    {
        $config = $jigsaw->getConfig('novak');
    
        $client = new Client(['base_uri' => $config['url']]);
        $response = $client->request('GET', '/api/collections', [
            'query' => [
                'key' => $config['key'],
            ],
        ]);
        $data = json_decode($response->getBody());
        
        foreach ($data as $name => $collection) {
            $jigsaw->setConfig("collections.$name.items", $collection->items);
        }
    }
}
