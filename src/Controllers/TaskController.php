<?php
class TaskController {
    private $task;

    public function __construct($db) {
        $this->task = new Task($db);
    }

    // Show all tasks
    public function index() {
        $tasks = $this->task->getAllTasks();
        require_once 'app/views/task_list.php';
    }

    // Add new task
    public function add() {
        if (isset($_POST['task_name']) && !empty($_POST['task_name'])) {
            $this->task->addTask($_POST['task_name']);
        }
        header('Location: /');
    }

    // Mark task as completed
    public function complete($id) {
        $this->task->completeTask($id);
        header('Location: /');
    }

    // Delete a task
    public function delete($id) {
        $this->task->deleteTask($id);
        header('Location: /');
    }
}
?>
