<?php
require_once __DIR__ . '/../php/config.php';
require_once __DIR__ . '/../php/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validate admin session
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}
?>

<h1 style="font-family: Arial, sans-serif; color: #333;">Manage Events</h1>

<!-- Add Event Form -->
<form action="<?php echo BASE_URL; ?>admin-actions/add-event.php" method="POST" style="margin-bottom: 30px;">
  <h2 style="font-family: Arial, sans-serif; color: #007bff;">Add Event</h2>
  <div style="margin-bottom: 15px;">
    <label for="title" style="display: block; font-weight: bold;">Event Title:</label>
    <input type="text" name="title" id="title" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="date" style="display: block; font-weight: bold;">Event Date:</label>
    <input type="date" name="date" id="date" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="start_hour" style="display: block; font-weight: bold;">Start Hour:</label>
    <input type="time" name="start_hour" id="start_hour" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="end_hour" style="display: block; font-weight: bold;">End Hour:</label>
    <input type="time" name="end_hour" id="end_hour" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="location" style="display: block; font-weight: bold;">Event Location:</label>
    <input type="text" name="location" id="location" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="description" style="display: block; font-weight: bold;">Event Description:</label>
    <textarea name="description" id="description" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; height: 100px; resize: none;"></textarea>
  </div>

  <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Add Event</button>
</form>

<!-- Existing Events Table -->
<h2 style="font-family: Arial, sans-serif; color: #007bff;">Existing Events</h2>
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
  <thead>
    <tr>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">Title</th>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">Date</th>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">Start Hour</th>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">End Hour</th>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">Location</th>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM events");
    $stmt->execute();
    while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td style='border: 1px solid #ccc; padding: 10px;'>" . htmlspecialchars($event['title']) . "</td>
                <td style='border: 1px solid #ccc; padding: 10px;'>" . htmlspecialchars($event['date']) . "</td>
                <td style='border: 1px solid #ccc; padding: 10px;'>" . htmlspecialchars($event['start_hour']) . "</td>
                <td style='border: 1px solid #ccc; padding: 10px;'>" . htmlspecialchars($event['end_hour']) . "</td>
                <td style='border: 1px solid #ccc; padding: 10px;'>" . htmlspecialchars($event['location']) . "</td>
                <td style='border: 1px solid #ccc; padding: 10px; text-align: center;'><a href='/Event-Planner-WebApp/admin-actions/delete-event.php?id=" . $event['id'] . "' style='color: #d9534f; text-decoration: none;'>Delete</a></td>
              </tr>";
    }
    ?>
  </tbody>
</table>
