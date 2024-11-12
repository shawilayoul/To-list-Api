<?php
class Task {
    private $conn;
    private $table = 'tasks';

    public $id;
    public $task_name;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all tasks
    public function getAllTasks() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        return $result;
    }

    // Add a new task
    public function addTask($task_name) {
        $query = "INSERT INTO " . $this->table . " (task_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $task_name);
        return $stmt->execute();
    }

    // Mark task as completed
    public function completeTask($id) {
        $query = "UPDATE " . $this->table . " SET status = 'completed' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Delete a task
    public function deleteTask($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
