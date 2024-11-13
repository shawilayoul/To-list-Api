<?php
namespace Controllers;
use Models\TaskModel;
class TaskController extends AbstractController {
private TaskModel $taskModel;
public function __construct() {
$this->taskModel = new TaskModel();
}
// GET /lists/{listId}/tasks
public function index(int $listId): void {
try {
$tasks = $this->taskModel->findByListId($listId);
$this->jsonResponse($tasks);
} catch (\Exception $e) {
$this->errorResponse($e->getMessage(), 500);
}
}
// POST /lists/{listId}/tasks
public function create(int $listId): void {
try {
$data = $this->getRequestData();
// Validation
if (!isset($data['title'])) {
$this->errorResponse("Le titre est obligatoire");
return;
}
$id = $this->taskModel->create(
$listId,
$data['title'],
$data['description'] ?? null
);
$this->jsonResponse([
'message' => 'Tâche créée avec succès',
'id' => $id
], 201);
} catch (\Exception $e) {
$this->errorResponse($e->getMessage(), 500);
}
}
}
