<?php

namespace Code16\Jigsaw;

class UrlGenerator
{
    public function to(string $path): string
    {
        return rtrim(app('config')->get('baseUrl'), '/') . '/' . trim($path, '/') . '/'; // add trailing slash for netlify
    }
}
