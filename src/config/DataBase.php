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
 
        if ($this->connection === null) {
            try {
                // Attempt to establish a connection
                $this->connection = new \PDO(
                    "mysql:host={$this->host};dbname={$this->dbname}",
                    $this->username,
                    $this->password
                );
                // Set PDO to throw exceptions on error
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // Log or display the error message for debugging
                error_log("Connection error: " . $e->getMessage());
                throw new \Exception("Connection error: " . $e->getMessage());
            }
        }
    // Retourne la connexion
    return $this->connection;
    }
}