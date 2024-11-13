<?php

namespace App\Models;

use App\Config\Database;

abstract class AbstractModel {
protected \PDO $db;
protected string $table;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Méthode commune pour nettoyer les entrées

    protected function sanitize(string $value): string {
        return htmlspecialchars(strip_tags($value));
    }

    // Méthodes communes à tous les models

    public function findById(int $id): ?array {

        $query = "SELECT * FROM {$this->table} WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch();

        return $result ?: null;

    }

    public function delete(int $id): bool {

        $query = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute(['id' => $id]);

    }
}