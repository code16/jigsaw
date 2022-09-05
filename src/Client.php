<?php

namespace Code16\Jigsaw;

use GuzzleHttp\Psr7\Response;

class Client
{
    protected \GuzzleHttp\Client $client;
    
    public function __construct(
        public string $url,
        public ?string $token,
    ) {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $url,
        ]);
    }
    
    public function getCollections(): array
    {
        $response = $this->request('GET', 'collections');
        
        return json_decode($response->getBody(), true);
    }
    
    protected function request(string $method, string $uri): Response
    {
        $headers = [];
        
        if ($this->token) {
            $headers['Authorization'] = "Bearer $this->token";
        }
        
        return $this->client->request($method, $uri, [
            'headers' => $headers,
        ]);
    }
}
