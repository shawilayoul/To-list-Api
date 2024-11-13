<?php
// Dans un fichier public/test.php
require_once '../src/Config/Database.php';
require_once '../src/Models/ListModel.php';
require_once '../src/Models/TaskModel.php';
// Test des listes
$listModel = new \Models\ListModel();
// On crée une liste
$listId = $listModel->create("Courses", "Liste des courses");
// On vérifie qu'on peut la retrouver
$list = $listModel->findById($listId);
var_dump($list);
echo '<br/><br/>';
// Test des tâches
$taskModel = new \Models\TaskModel();
// On crée une tâche dans notre liste
$taskId = $taskModel->create($listId, "Pain", "Acheter du pain");
// On récupère toutes les tâches de la liste
$tasks = $taskModel->findByListId($listId);
var_dump($tasks);