<?php
require_once __DIR__ . '/../php/config.php';
require_once __DIR__ . '/../php/db.php';
session_start();

// Validate admin session
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $event_id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
        $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: " . BASE_URL . "admin-panel.php?page=manage-events&status=deleted");
        exit();
    } catch (PDOException $e) {
        error_log("Delete Event Error: " . $e->getMessage());
        header("Location: " . BASE_URL . "admin-panel.php?page=manage-events&status=error");
        exit();
    }
} else {
    header("Location: " . BASE_URL . "admin-panel.php?page=manage-events&status=invalid_request");
    exit();
}
?>
