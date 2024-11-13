<?php
// Inclure tous les fichiers nécessaires
require_once '../src/Config/Database.php';
require_once '../src/Models/AbstractModel.php';
require_once '../src/Models/ListModel.php';
require_once '../src/Models/TaskModel.php';
require_once '../src/Controllers/AbstractController.php';
require_once '../src/Controllers/ListController.php';
require_once '../src/Controllers/TaskController.php';
require_once '../src/Config/Router.php';
use Config\Router;
// Configuration des en-têtes
header('Content-Type: application/json');
// Création et configuration du routeur
$router = new Router();
// Routes pour les listes
$router->addRoute('GET', 'lists', 'ListController', 'index');
$router->addRoute('GET', 'lists/{id}', 'ListController', 'show');
$router->addRoute('POST', 'lists', 'ListController', 'create');
// Routes pour les tâches
$router->addRoute('GET', 'lists/{id}/tasks', 'TaskController', 'index');
$router->addRoute('POST', 'lists/{id}/tasks', 'TaskController', 'create');
try {
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_GET['uri'] ?? '';
$router->handleRequest($method, $uri);
} catch (Exception $e) {
http_response_code(500);
echo json_encode(['error' => $e->getMessage()]);
}
