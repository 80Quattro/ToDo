<?php

declare(strict_types = 1);

namespace App\Models;

use App\Exceptions\DataNotFoundException;
use App\Model;
use LDAP\Result;

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

    public function get(string $roomId): array
    {
        $sql = "SELECT name, create_date, owner FROM rooms WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roomId]);
        $result = $stmt->fetch();
        if(!$result) {
            throw new DataNotFoundException();
        }
        return $result;
    }

}