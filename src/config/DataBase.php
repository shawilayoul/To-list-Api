<?php
namespace Config;
class Database {
// Paramètres de connexion à la base de données
private string $host = "localhost";
private string $dbname = "todo_list_api";
private string $username = "root";
private string $password = "root_password";
private ?\PDO $connection = null;
public function getConnection(): \PDO {
// Si la connexion n'existe pas encore
if ($this->connection === null) {
try {
// Tentative de connexion à la base
//TODO A vous de compléter la code
} catch(\PDOException $e) {
// En cas d'erreur, on lance une exception
throw new \Exception("Connection error: " . $e->getMessage());
}
}
// Retourne la connexion
return $this->connection;
}
}