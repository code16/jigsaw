<?php

use Illuminate\View\Factory;


function view(string $view, array $data = [])
{
    return app(Factory::class)->make($view, $data);
}
