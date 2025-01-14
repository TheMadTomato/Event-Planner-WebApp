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

<h1 style="font-family: Arial, sans-serif; color: #333;">Manage Emails</h1>

<!-- Send Broadcast Email Form -->
<form action="/Event-Planner-WebApp/admin-actions/send-mail.php" method="POST" style="margin-bottom: 30px;">
  <h2 style="font-family: Arial, sans-serif; color: #007bff;">Send Broadcast Email</h2>
  <div style="margin-bottom: 15px;">
    <label for="broadcast_subject" style="display: block; font-weight: bold;">Subject:</label>
    <input type="text" name="broadcast_subject" id="broadcast_subject" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="broadcast_message" style="display: block; font-weight: bold;">Message:</label>
    <textarea name="broadcast_message" id="broadcast_message" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; height: 100px; resize: none;"></textarea>
  </div>

  <button type="submit" name="broadcast" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Send Broadcast Email</button>
</form>

<!-- Send Single Email Form -->
<form action="/Event-Planner-WebApp/admin-actions/send-mail.php" method="POST" style="margin-bottom: 30px;">
  <h2 style="font-family: Arial, sans-serif; color: #007bff;">Send Single Email</h2>
  <div style="margin-bottom: 15px;">
    <label for="recipient_email" style="display: block; font-weight: bold;">Recipient Email:</label>
    <input type="email" name="recipient_email" id="recipient_email" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="single_subject" style="display: block; font-weight: bold;">Subject:</label>
    <input type="text" name="single_subject" id="single_subject" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
  </div>

  <div style="margin-bottom: 15px;">
    <label for="single_message" style="display: block; font-weight: bold;">Message:</label>
    <textarea name="single_message" id="single_message" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; height: 100px; resize: none;"></textarea>
  </div>

  <button type="submit" name="single" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Send Email</button>
</form>

<!-- Subscribed Users Table -->
<h2 style="font-family: Arial, sans-serif; color: #007bff;">Subscribed Users</h2>
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
  <thead>
    <tr>
      <th style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $stmt = $pdo->prepare("SELECT email FROM users");
    $stmt->execute();
    while ($subscribers = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td style='border: 1px solid #ccc; padding: 10px;'>" . htmlspecialchars($subscribers['email']) . "</td>
              </tr>";
    }
    ?>
  </tbody>
</table>
