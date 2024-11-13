<?php

namespace App\Controllers;

use App\Models\ListModel;

class ListController extends AbstractController
{
    private ListModel $listModel;

    public function __construct()
    {
        $this->listModel = new ListModel();
    }


    // GET /lists

    public function index(): void
    {
        try {
            $lists = $this->listModel->findAll();
            $this->jsonResponse($lists);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }


    // GET /lists/{id}
    public function show(int $id): void
    {
        try {
            $list = $this->listModel->findById($id);
            if (!$list) {
                $this->errorResponse("Liste non trouvée", 404);
                return;
            }
            $this->jsonResponse($list);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }


    // POST /lists
    public function create(): void
    {
        try {
            $data = $this->getRequestData();
            // Validation
            if (!isset($data['title'])) {
                $this->errorResponse("Le titre est obligatoire");
                return;
            }

            $id = $this->listModel->create(
                $data['title'],
                $data['description'] ?? null
            );

            $this->jsonResponse([
                'message' => 'Liste créée avec succès',
                'id' => $id
            ], 201);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }

    // PUT /lists/{id}
    public function update(int $id): void
    {
        try {
            $data = $this->getRequestData();
            if (!isset($data['title'])) {
                $this->errorResponse("Le titre est obligatoire");
                return;
            }
            $success = $this->listModel->update(
                $id,
                $data['title'],
                $data['description'] ?? null
            );
            if (!$success) {
                $this->errorResponse("Liste non trouvée", 404);
                return;
            }
            $this->jsonResponse(['message' => 'Liste mise à jour avec succès']);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
    // DELETE /lists/{id}
    public function delete(int $id): void
    {
        try {
            $success = $this->listModel->delete($id);
            if (!$success) {
                $this->errorResponse("Liste non trouvée", 404);
                return;
            }
            $this->jsonResponse(['message' => 'Liste supprimée avec succès']);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
}
