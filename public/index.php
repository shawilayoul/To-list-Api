<?php
// Autoload the classes
function autoload($class_name) {
    $file = 'app/' . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('autoload');

// Include database connection
require_once 'app/config/Database.php';

// Create a database connection
$database = new Database();
$db = $database->connect();

// Define routes
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Create a controller
$taskController = new TaskController($db);

// Basic Routing
if ($request_uri === '/' && $request_method === 'GET') {
    $taskController->index(); // Show all tasks
} elseif ($request_uri === '/task/add' && $request_method === 'POST') {
    $taskController->add(); // Add a new task
} elseif (preg_match('/^\/task\/complete\/(\d+)$/', $request_uri, $matches) && $request_method === 'GET') {
    $taskController->complete($matches[1]); // Mark task as complete
} elseif (preg_match('/^\/task\/delete\/(\d+)$/', $request_uri, $matches) && $request_method === 'GET') {
    $taskController->delete($matches[1]); // Delete a task
} else {
    echo "404 Not Found";
}
?>

