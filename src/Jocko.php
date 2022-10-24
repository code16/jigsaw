<?php

namespace Code16\Jigsaw;

use Illuminate\Filesystem\Filesystem;
use TightenCo\Jigsaw\Jigsaw;

class Jocko
{
    protected JockoClient $client;
    protected Filesystem $filesystem;
    protected bool $shouldCache = false;
    protected string $cachePath;
    
    public function __construct(Jigsaw $jigsaw)
    {
        $this->client = new JockoClient(
            $jigsaw->getConfig('jocko_api.url'),
            $jigsaw->getConfig('jocko_api.token')
        );
        $this->shouldCache = $jigsaw->getConfig('jocko_api.cache') ?? false;
        $this->filesystem = $jigsaw->getFilesystem();
        $this->cachePath = $jigsaw->app['cwd'] . '/jocko_cache';
    }
    
    public function getCollections(): array
    {
        return $this->withCache('collections', fn () => $this->client->getCollections());
    }
    
    public function getConfig(): array
    {
        return $this->withCache('config', fn () => $this->client->getConfig());
    }
    
    protected function withCache(string $cacheKey, callable $getter)
    {
        $cachedFilePath = $this->cachePath . "/$cacheKey.json";
        
        if($this->shouldCache && $this->filesystem->exists($cachedFilePath)) {
            $content = $this->filesystem->get($cachedFilePath);
            return json_decode($content, true);
        }
        
        $data = $getter();
        
        if($this->shouldCache) {
            $this->filesystem->ensureDirectoryExists($this->filesystem->dirname($cachedFilePath));
            $this->filesystem->put($cachedFilePath, json_encode($data));
        }
        
        return $data;
    }
}
