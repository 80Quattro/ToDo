<?php

declare(strict_types = 1);

namespace App;

use stdClass;

abstract class Controller
{

    public function __construct(protected stdClass $body, protected array $post, protected array $get)
    {

    }
}