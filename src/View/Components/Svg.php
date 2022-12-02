<?php

namespace Code16\Jigsaw\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Svg extends Component
{
    public function render()
    {
        $svgName = Str::after($this->componentName, 'icon-');
        $content = app('svg')[$svgName];
        
        return str_replace('<svg', '<svg {{ $attributes }}', $content);
    }
}
