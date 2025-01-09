<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $title = $_POST['event_title'];
    $date = $_POST['event_date'];
    $location = $_POST['event_location'];

    $stmt = $pdo->prepare("INSERT INTO events (title, date, location) VALUES (?, ?, ?)");
    if ($stmt->execute([$title, $date, $location])) {
        echo "Event added successfully!";
    } else {
        echo "Error adding event!";
    }
}
?>
