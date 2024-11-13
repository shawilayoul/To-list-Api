<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends AbstractController
{
    private TaskModel $taskModel;
    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }
    // GET /lists/{listId}/tasks
    public function index(int $listId): void
    {
        try {
            $tasks = $this->taskModel->findByListId($listId);
            $this->jsonResponse($tasks);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
    // POST /lists/{listId}/tasks
    public function create(int $listId): void
    {
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

    // PUT /tasks/{id}
    public function update(int $id): void
    {
        try {
            $data = $this->getRequestData();
            if (!isset($data['title'])) {
                $this->errorResponse("Le titre est obligatoire");
                return;
            }
            $success = $this->taskModel->update(
                $id,
                $data['title'],
                $data['description'] ?? null,
                $data['due_date'] ?? null
            );
            if (!$success) {
                $this->errorResponse("Tâche non trouvée", 404);
                return;
            }
            $this->jsonResponse(['message' => 'Tâche mise à jour avec succès']);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
    // PATCH /tasks/{id}/status
    public function updateStatus(int $id): void
    {
        try {
            $data = $this->getRequestData();
            if (!isset($data['is_done'])) {
                $this->errorResponse("Le statut est obligatoire");
                return;
            }
            $success = $this->taskModel->updateStatus($id, (bool)$data['is_done']);
            if (!$success) {
                $this->errorResponse("Tâche non trouvée", 404);
                return;
            }
            $this->jsonResponse(['message' => 'Statut mis à jour avec succès']);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
    // DELETE /tasks/{id}
    public function delete(int $id): void
    {
        try {
            $success = $this->taskModel->delete($id);
            if (!$success) {
                $this->errorResponse("Tâche non trouvée", 404);
                return;
            }
            $this->jsonResponse(['message' => 'Tâche supprimée avec succès']);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
}
