<?php

namespace Code16\Jigsaw\Listeners;

use Code16\Jigsaw\Jocko;
use TightenCo\Jigsaw\Jigsaw;

class ClearCache
{
    public function handle(Jigsaw $jigsaw)
    {
        $jocko = new Jocko($jigsaw);
        
        if(!$jocko->cacheEnabled()) {
            $jocko->clearCache();
        }
    }
}
