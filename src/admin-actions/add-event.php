<?php
require_once __DIR__ . '/../php/config.php';
require_once __DIR__ . '/../php/db.php';
session_start();

// Validate admin session
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $start_hour = $_POST['start_hour'] ?? '';
    $end_hour = $_POST['end_hour'] ?? '';
    $location = $_POST['location'] ?? '';
    $description = $_POST['description'] ?? '';

    // Validate form inputs
    if (!empty($title) && !empty($date) && !empty($start_hour) && !empty($end_hour) && !empty($location)) {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO events (title, date, start_hour, end_hour, location, description) 
                 VALUES (:title, :date, :start_hour, :end_hour, :location, :description)"
            );
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':start_hour', $start_hour);
            $stmt->bindParam(':end_hour', $end_hour);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            header("Location: " . BASE_URL . "admin-panel.php?page=manage-events&status=added");
            exit();
        } catch (PDOException $e) {
            error_log("Add Event Error: " . $e->getMessage());
            header("Location: " . BASE_URL . "admin-panel.php?page=manage-events&status=error");
            exit();
        }
    } else {
        header("Location: " . BASE_URL . "admin-panel.php?page=manage-events&status=missing_fields");
        exit();
    }
}
?>
q