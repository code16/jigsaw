<?php

namespace Code16\Jigsaw;

class Image
{
    public function __construct(
        public string $src,
    ) {
    }
    
    public function thumbnail(?int $width = null, ?int $height = null, ?float $scale = 1): string
    {
        $width = $width ? $width * $scale : null;
        $height = $height ? $height * $scale : null;
        
        // https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations
        return $this->src . '?tr=' . implode(',', array_keys(array_filter([
            "w-$width" => $width,
            "h-$height" => $height,
            "c-at_max" => true,
        ])));
    }
    
    public function responsiveSrcSet(array $sizes = [640, 750, 828, 1080, 1200, 1920, 2048, 3840]): string
    {
        return collect($sizes)->map(fn ($size) => "{$this->thumbnail($size)} {$size}w")->join(', ');
    }
    
    public function __toString(): string
    {
        return $this->src;
    }
}
