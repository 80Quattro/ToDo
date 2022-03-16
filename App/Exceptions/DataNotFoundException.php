<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    protected $message = 'Data in database is not found';
}