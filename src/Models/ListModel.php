<?php

namespace App\Models;

class ListModel extends AbstractModel
{
    protected string $table = "lists";

    public function create(string $title, ?string $description = null): int
    {
        $query = "INSERT INTO {$this->table} (title, description) 
                VALUES (:title, :description)";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'title' => $this->sanitize($title),
            'description' => $description ? $this->sanitize($description) : null
        ]);

        return (int)$this->db->lastInsertId();
    }

    // Mise à jour d'une liste
    public function update(int $id, string $title, ?string $description = null): bool
    {
        $query = "UPDATE {$this->table}
    SET title = :title, description = :description
    WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'title' => $this->sanitize($title),
            'description' => $description ? $this->sanitize($description) : null
        ]);
    }
    // Compter les tâches d'une liste
    public function countTasks(int $id): int
    {
        $query = "SELECT COUNT(*) as total FROM tasks WHERE list_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return (int)$stmt->fetch()['total'];
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }
}
