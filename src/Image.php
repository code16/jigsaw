<?php

namespace Code16\JockoClient;

class Image
{
    public function __construct(
        public string $src,
    ) {
    }
    
    public function thumbnail(?int $width = null, ?int $height = null): string
    {
        // https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations
        return $this->src . '?tr=' . implode(',', array_keys(array_filter([
            "w-$width" => $width,
            "h-$height" => $height,
        ])));
    }
}
