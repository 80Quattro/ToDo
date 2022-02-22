<?php

declare(strict_types = 1);

namespace App\Models;

use App\Model;

class ToDo extends Model
{
    public function create(string $name, string $description = ''): string
    {
        return '';
    }

    public function getByRoomId(string $roomId): void
    {
        
    }
}