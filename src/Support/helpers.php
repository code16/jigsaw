<?php

use Illuminate\Container\Container;
use Illuminate\View\Factory;


function view(string $view, array $data = [])
{
    return Container::getInstance()->make(Factory::class)
        ->make($view, $data);
}


