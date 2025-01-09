<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    echo "Access denied. You do not have permission to access this page.";
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if user is an admin
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect non-admins to homepage
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Event Planner</title>
  <link rel="stylesheet" href="css/admin-panel.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="admin-container">
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <ul>
        <li><a href="#dashboard">Dashboard</a></li>
        <li><a href="#manage-events">Manage Events</a></li>
        <li><a href="#manage-emails">Manage Emails</a></li>
        <li><a href="#analytics">View Analytics</a></li>
        <li><a href="php/logout.php">Logout</a></li>
      </ul>
    </aside>

    <main class="content">
      <section id="dashboard">
        <h1>Welcome, Admin</h1>
        <p>Use the panel to manage events, emails, and view analytics.</p>
      </section>

      <section id="manage-events">
        <h2>Manage Events</h2>
        <form>
          <div class="input-group">
            <label for="event-title">Event Title</label>
            <input type="text" id="event-title" placeholder="Enter event title" required>
          </div>
          <div class="input-group">
            <label for="event-date">Event Date</label>
            <input type="date" id="event-date" required>
          </div>
          <div class="input-group">
            <label for="event-location">Event Location</label>
            <input type="text" id="event-location" placeholder="Enter location" required>
          </div>
          <button type="submit" class="btn-primary">Add Event</button>
        </form>
      </section>

      <section id="manage-emails">
        <h2>Manage Emails</h2>
        <form>
          <div class="input-group">
            <label for="email-subject">Email Subject</label>
            <input type="text" id="email-subject" placeholder="Enter subject" required>
          </div>
          <div class="input-group">
            <label for="email-body">Email Body</label>
            <textarea id="email-body" placeholder="Enter email content" required></textarea>
          </div>
          <button type="submit" class="btn-primary">Send Email</button>
        </form>
      </section>

      <section id="analytics">
        <h2>View Analytics</h2>
        <p>Coming Soon: Analytics dashboard to view user activity and event statistics.</p>
      </section>
    </main>
  </div>
</body>
</html>
