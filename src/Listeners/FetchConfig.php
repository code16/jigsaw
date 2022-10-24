<?php

namespace Code16\Jigsaw\Listeners;

use Code16\Jigsaw\JockoClient;
use TightenCo\Jigsaw\Jigsaw;

class FetchConfig
{
    public function handle(Jigsaw $jigsaw)
    {
        $config = $jigsaw->getConfig('jocko_api');
    
        $client = new JockoClient($config['url'], $config['token']);
        $config = $client->getConfig();
        
        foreach ($config as $key => $value) {
            $jigsaw->setConfig($key, $value);
        }
    }
}
