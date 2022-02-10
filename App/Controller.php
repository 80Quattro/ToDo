<?php

declare(strict_types = 1);

namespace App;

abstract class Controller
{

    public function __construct(protected array $post, protected array $get)
    {

    }
}