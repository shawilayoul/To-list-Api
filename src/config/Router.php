<?php
namespace Config;
class Router {
    private array $routes = [];
    public function addRoute(string $method, string $path, string $controller, string
    $action): void {
    $this->routes[] = [
    'method' => $method,
    'path' => $path,
    'controller' => $controller,
    'action' => $action
    ];
    }
    public function handleRequest(string $method, string $uri): void {
    $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
    foreach ($this->routes as $route) {
    if ($route['method'] !== $method) {
    continue;
    }
    // Transformer la route en expression régulière
    $pattern = preg_replace('/\{(\w+)\}/', '(\d+)', $route['path']);
    $pattern = "@^" . str_replace('/', '\/', $pattern) . "$@D";
    if (preg_match($pattern, $uri, $matches)) {
    // Enlever le premier élément (match complet)
    array_shift($matches);
    // Créer le contrôleur et appeler l'action
    $controllerName = "Controllers\\" . $route['controller'];
    $controller = new $controllerName();
    call_user_func_array([$controller, $route['action']], $matches);
    return;
    }
    }
    // Route non trouvée
    http_response_code(404);
    echo json_encode(['error' => 'Route non trouvée']);
    }
    }