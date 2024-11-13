<?php

require_once '../vendor/autoload.php';

use App\Config\Router;
use App\Controllers\ListController;
use App\Controllers\TaskController;

// Configuration des en-têtes
header('Content-Type: application/json');

// Création et configuration du routeur
$router = new Router();
// Routes pour les listes
$router->addRoute('GET', 'lists', 'ListController', 'index');
$router->addRoute('GET', 'lists/{id}', 'ListController', 'show');
$router->addRoute('POST', 'lists', 'ListController', 'create');
$router->addRoute('PUT', 'lists/{id}', 'ListController', 'update');
$router->addRoute('DELETE', 'lists/{id}', 'ListController', 'delete');
// Routes pour les tâches
$router->addRoute('GET', 'lists/{id}/tasks', 'TaskController', 'index');
$router->addRoute('POST', 'lists/{id}/tasks', 'TaskController', 'create');
$router->addRoute('PUT', 'tasks/{id}', 'TaskController', 'update');
$router->addRoute('PATCH', 'tasks/{id}/status', 'TaskController', 'updateStatus');
$router->addRoute('DELETE', 'tasks/{id}', 'TaskController', 'delete');

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_GET['uri'] ?? '';
    $router->handleRequest($method, $uri);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
