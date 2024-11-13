<?php
namespace Controllers;
abstract class AbstractController {
// Envoyer une réponse JSON
protected function jsonResponse($data, int $statusCode = 200): void {
http_response_code($statusCode);
echo json_encode($data);
}
// Récupérer les données POST
protected function getRequestData(): ?array {
return json_decode(file_get_contents('php://input'), true);
}
// Envoyer une erreur
protected function errorResponse(string $message, int $statusCode = 400): void {
$this->jsonResponse(['error' => $message], $statusCode);
}
}