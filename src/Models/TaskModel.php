<?php

namespace App\Models;

class TaskModel extends AbstractModel
{
    protected string $table = "tasks";
    // On garde uniquement les méthodes spécifiques aux tâches

    public function create(int $listId, string $title, ?string $description = null): int
    {
        $query = "INSERT INTO {$this->table} (list_id, title, description) 
        VALUES (:list_id, :title, :description)";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'list_id' => $listId,
            'title' => $this->sanitize($title),
            'description' => $description ? $this->sanitize($description) : null
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function findByListId(int $listId): array
    {
        $query = "SELECT * FROM {$this->table} WHERE list_id = :list_id";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['list_id' => $listId]);

        return $stmt->fetchAll();
    }

    // Mise à jour d'une tâche
    public function update(int $id, string $title, ?string $description = null, ?string
    $dueDate = null): bool
    {
        $query = "UPDATE {$this->table}
SET title = :title, description = :description, due_date = :due_date
WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'title' => $this->sanitize($title),
            'description' => $description ? $this->sanitize($description) : null,
            'due_date' => $dueDate
        ]);
    }
    // Récupérer les tâches à faire
    public function findPending(int $listId): array
    {
        $query = "SELECT * FROM {$this->table}
WHERE list_id = :list_id AND is_done = false
ORDER BY due_date ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['list_id' => $listId]);
        return $stmt->fetchAll();
    }
    // Mettre à jour le statut d'une tâche
    public function updateStatus(int $id, bool $isDone): bool
    {
        $query = "UPDATE {$this->table} SET is_done = :is_done WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'is_done' => $isDone
        ]);
    }
}
