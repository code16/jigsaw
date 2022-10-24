<?php

namespace Code16\Jigsaw\Listeners;

use Code16\Jigsaw\Jocko;
use TightenCo\Jigsaw\Jigsaw;

class FetchConfig
{
    public function handle(Jigsaw $jigsaw)
    {
        $jocko = new Jocko($jigsaw);
        $config = $jocko->getConfig();
        
        foreach ($config as $key => $value) {
            $jigsaw->setConfig($key, $value);
        }
    }
}
