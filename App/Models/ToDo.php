<?php

declare(strict_types = 1);

namespace App\Models;

use App\Model;

class ToDo extends Model
{
    public function create(string $roomId, string $name, string $description, string $owner): int
    {
        // TODO try ... catch
        $sql = "INSERT INTO todos (roomId, name, description, owner, status) VALUES (?, ?, ?, ?, 'TODO')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roomId, $name, $description, $owner]);
        return (int) $this->db->lastInsertId();
    }

    public function getAllByRoomId(string $roomId): array
    {
        $sql = "SELECT id, name, description, owner, status FROM todos WHERE roomId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roomId]);
        return $stmt->fetchAll();
    }

    public function change(string $id, array $data): void
    {
        $sql = "UPDATE todos SET";
        foreach($data as $key => $val) {
            $sql .= " $key = '$val',";
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

}