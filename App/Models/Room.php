<?php

declare(strict_types = 1);

namespace App\Models;

use App\Model;

class Room extends Model
{

    public function create(string $name): string
    {
        $sql = "INSERT INTO rooms (name, owner) VALUES (UUID_SHORT(), ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);
        $id = $this->db->lastInsertId();

        $sql =  "SELECT name FROM rooms WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();
    }

    public function get(string $id): array
    {
        $sql = "SELECT name, description, owner, status FROM todos WHERE roomId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

}