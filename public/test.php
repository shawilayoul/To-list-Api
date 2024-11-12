<?php
// test.php
try {
    $db = new PDO("mysql:host=localhost;dbname=ecommercephp", "root", "");
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
