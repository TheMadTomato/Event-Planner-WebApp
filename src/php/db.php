<?php
$host = '127.0.0.1'; // or 'localhost'
$db = 'event_planner'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password (set in phpMyAdmin)

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
