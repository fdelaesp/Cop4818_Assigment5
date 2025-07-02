<?php
// config.php — database connection
session_start();

$DB_HOST = 'localhost';
$DB_NAME = 'login_system';
$DB_USER = 'your_db_user';
$DB_PASS = 'your_db_password';

try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
