<?php
require_once '../vendor/autoload.php';

use App\Models\ListModel;
use App\Models\TaskModel;

// Test des listes
    $listModel = new ListModel();
// On crée une liste
    $listId = $listModel->create("Courses", "Liste des courses");
// On vérifie qu'on peut la retrouver
    $list = $listModel->findById($listId);
    var_dump($list);
    echo '<br/><br/>';
// Test des tâches
    $taskModel = new TaskModel();
// On crée une tâche dans notre liste
    $taskId = $taskModel->create($listId, "Pain", "Acheter du pain");
// On récupère toutes les tâches de la liste
    $tasks = $taskModel->findByListId($listId);
    var_dump($tasks);