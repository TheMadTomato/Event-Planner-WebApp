<?php
// Database Configuration
$host = 'localhost';
$dbname = 'event_planner';
$username = 'root'; // Default for WAMP
$password = ''; // Default for WAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
