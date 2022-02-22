<?php

declare(strict_types = 1);

namespace App\Models;

use App\Model;

class ToDo extends Model
{
    public function create(string $roomId, string $name, string $description, string $owner): void
    {
        // TODO try ... catch
        $sql = "INSERT INTO todos (roomId, name, description, owner, status) VALUES (?, ?, ?, ?, 'TODO')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roomId, $name, $description, $owner]);
    }

    public function getByRoomId(string $roomId): void
    {
        
    }
}